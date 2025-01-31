<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\Services;
use App\Models\Products;
use App\Models\Revenues;
use App\Models\User;
use App\Models\Visitors;
use App\Models\Cart;
use App\Models\OrderHistory;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('dashboards.dashboard', compact('assets'));
    }

    public function orderHistory(Request $request)
    {
        $assets = ['chart', 'animation'];
        $user = auth()->user();

        $completedOrders = OrderHistory::select('id', 'order_id', 'user_id', 'product_name', 'purchased_date', 'total_amount', 'base_price', 'quantity', 'status')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->get();    

        $pendingOrders = OrderHistory::select('id', 'order_id', 'user_id', 'product_name', 'purchased_date', 'total_amount', 'base_price', 'quantity', 'status')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->get();

        $history = $completedOrders->concat($pendingOrders);

        return response()
            ->view('marketplace.order-list', compact('assets', 'history'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function cart(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart;
        $productIds = [];

        foreach ($cart as $cartItems) {
            array_push($productIds, $cartItems->product_id);
        }

        if ($cart) {
            // $productIds = $cart->pluck('product_id')->toArray();

            $availableProductIds = Products::whereIn('id', $productIds)
                ->where('isAvailable', true)
                ->pluck('id')
                ->toArray();

            $removedProductIds = array_diff($productIds, $availableProductIds);
            Cart::where('user_id', $user->id)
                ->whereIn('product_id', $removedProductIds)
                ->delete();

            $cartItems = Products::whereIn('id', $availableProductIds)->get();
            $productQuantities = array_count_values($productIds);

            foreach ($cartItems as $item) {
                $item->quantity = $productQuantities[$item->id];
                $product = Products::find($item->id);
                $item->available_quantity = $product->quantity;
                $item->disableAddToCart = ($item->quantity >= $item->available_quantity);
            }

        } else {
            $cartItems = [];
        }

        $assets = ['chart', 'animation'];
        return response()
            ->view('marketplace.cart', compact('assets', 'cartItems'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function checkout(Request $request)
    {
        $assets = ['chart', 'animation'];
        $user = auth()->user();

        $cartItemIds = $request->input('checkedItems');
        if (!is_array($cartItemIds)) {
            return redirect()->route('cart');
        }

        $cartItems = Cart::whereIn('product_id', $cartItemIds)->where('user_id', $user->id)->get();
        $productIds = $cartItems->pluck('product_id')->toArray();

        $products = Products::whereIn('id', $productIds)->get();

        $productQuantities = array_count_values($productIds);

        foreach ($products as $product) {
            $product->quantity = $productQuantities[$product->id];
        }

        return response()
            ->view('marketplace.checkout', compact('assets', 'products'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function adminDashboard(Request $request)
    {
        $assets = ['chart', 'animation'];
        $visitorCount = Visitors::count();
        $serviceCategories = Services::select('id', 'title', 'price')->get();
        $productCategories = Products::select('id', 'title', 'price')->get();

        $currentYear = now()->year;
        $products = [];
        $services = [];
        $totalSalesProducts = [];
        $totalSalesServices = [];
        $totalRevenue = 0;
        $total_income = 0;

        for ($month = 1; $month <= 12; $month++) {
            $productCount = Revenues::whereYear('purchase_date', $currentYear)
                ->whereMonth('purchase_date', $month)
                ->where('types', 'product')
                ->count();

            $serviceCount = Revenues::whereYear('purchase_date', $currentYear)
                ->whereMonth('purchase_date', $month)
                ->where('types', '!=', 'product')
                ->count();

            $totalSalesProduct = Revenues::whereYear('purchase_date', $currentYear)
                ->whereMonth('purchase_date', $month)
                ->where('types', 'product')
                ->sum('amount');

            $totalSalesService = Revenues::whereYear('purchase_date', $currentYear)
                ->whereMonth('purchase_date', $month)
                ->where('types', '!=', 'product')
                ->sum('amount');

            $products[$month] = $productCount;
            $services[$month] = $serviceCount;
            $totalSalesProducts[$month] = $totalSalesProduct;
            $totalSalesServices[$month] = $totalSalesService;
            $totalRevenue += ($totalSalesProduct + $totalSalesService);
        }
        $total_income = $totalRevenue * 0.15;

        $latestRevenues = Revenues::latest()
            ->limit(4)
            ->get();

        $customerCounts = Revenues::count();
        $productCounts = Products::count();
        $serviceCounts = Services::count();
        $tableRevenues = Revenues::select('types', 'category', 'purchase_date', 'amount')->get();
        $users = User::role('user')->get();

        return response()
            ->view('dashboards.adminDashboard', compact('assets', 'visitorCount', 'products', 'services', 'totalSalesProducts', 'totalSalesServices', 'totalRevenue', 'latestRevenues', 'customerCounts', 'productCounts', 'serviceCounts', 'serviceCategories', 'productCategories', 'total_income', 'tableRevenues', 'users'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /*
     * Menu Style Routs
     */
    public function aboutus(Request $request)
    {
        $assets = ['chart', 'animation'];

        $abouts = AboutUs::select('id', 'title', 'header', 'body', 'footer', 'image')
            ->orderBy('created_at', 'desc')
            ->get();
        // Website visitor
        $count = Visitors::count();

        // Resolved Issues
        $reviews = Reviews::whereBetween('stars', [3, 5])->get();
        $resolvedIssues = count($reviews);

        // Clients
        $clients = Revenues::count();
        $projects = Revenues::where("category", "Programming Commission")->count();

        return view('navComponents.aboutus', compact('assets', 'count', 'resolvedIssues', 'clients', 'abouts', 'projects'));
    }

    public function team(Request $request)
    {
        $assets = ['chart', 'animation'];
        $users = User::role(['admin', 'employee'])->get();
        return view('navComponents.team', compact('assets', 'users'));
    }

    public function payment(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('marketplace.payment', compact('assets'));
    }

    public function adminReviews(Request $request)
    {
        $assets = ['chart', 'animation'];

        $reviewsQuery = Reviews::with('user')
            ->select('id', 'user_id', 'rating_type', 'stars', 'comments', 'image', 'category', 'replies')
            ->whereNull('replies')
            ->orderBy('created_at', 'asc')
            ->paginate(4);

        Paginator::useBootstrap();

        return response()
            ->view('admin.adminReviews', compact('assets', 'reviewsQuery'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function reviews(Request $request)
    {
        $assets = ['chart', 'animation'];
        $reviews = null;
        $averageStars = 0;
        $selectedCategory = $request->input('category', 'all');

        $serviceCategories = Services::select('title')->get();
        $productCategories = Products::select('title')->get();

        $reviewsQuery = Reviews::with('user');
        $category = $request->input('category');
        $starsFilter = $request->input('stars');

        if (Auth::check()) {
            $currentUserId = Auth::id();
            $reviewsQuery->orderByRaw("CASE WHEN user_id = $currentUserId THEN 0 ELSE 1 END");
        }

        $reviewsQuery->orderBy('created_at', 'desc');
        $oneStar = Reviews::where('stars', '1');
        $twoStar = Reviews::where('stars', '2');
        $threeStar = Reviews::where('stars', '3');
        $fourStar = Reviews::where('stars', '4');
        $fiveStar = Reviews::where('stars', '5');

        if ($category && $category !== 'all') {
            $reviewsQuery->where(function ($q) use ($category) {
                $q->where('rating_type', 'product')
                    ->orWhere('rating_type', 'service');
            })->where('category', $category);
            $oneStar->where('category', $category);
            $twoStar->where('category', $category);
            $threeStar->where('category', $category);
            $fourStar->where('category', $category);
            $fiveStar->where('category', $category);
        }

        // Applying star rating filter
        if ($starsFilter && $starsFilter !== 'all') {
            $reviewsQuery->where('stars', $starsFilter);
        }

        $counts = Reviews::count();
        $oneStarCount = $oneStar->count();
        $twoStarCount = $twoStar->count();
        $threeStarCount = $threeStar->count();
        $fourStarCount = $fourStar->count();
        $fiveStarCount = $fiveStar->count();
        $stars = Reviews::select('stars')->get();
        if ($counts > 0) {
            $totalStars = $stars->sum('stars');
            $averageStars = $totalStars / $counts;
        }

        $reviews = $reviewsQuery->paginate(4);

        Paginator::useBootstrap();

        return view('navComponents.reviews', compact('assets', 'reviews', 'counts', 'averageStars', 'serviceCategories', 'productCategories', 'selectedCategory', 'starsFilter', 'oneStarCount', 'twoStarCount', 'threeStarCount', 'fourStarCount', 'fiveStarCount'));
    }

    public function services(Request $request)
    {
        $query = $request->input('search');

        $availableServices = Services::select('id', 'title', 'description', 'price', 'image', 'isAvailable')
            ->where('isAvailable', true)
            ->orderBy('created_at', 'asc');

        $allServices = Services::select('id', 'title', 'description', 'price', 'image', 'isAvailable')
            ->orderBy('created_at', 'asc'); 

        if ($query) {
            $availableServices->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%');
            });
            
            $allServices->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        $services = $availableServices->union($allServices)->paginate(4);

        Paginator::useBootstrap();
        return view('marketplace.services', compact('services', 'query'));
    }
    
    public function products(Request $request)
    {
        $query = $request->input('search');

        $availableProducts = Products::select('id', 'title', 'description', 'price', 'image', 'isAvailable', 'status')
            ->where('isAvailable', true)
            ->orderBy('created_at', 'asc');

        $allProducts = Products::select('id', 'title', 'description', 'price', 'image', 'isAvailable', 'status')
            ->orderBy('created_at', 'asc');

        if ($query) {
            $availableProducts->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%');
            });
        
            $allProducts->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                            ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        $products = $availableProducts->union($allProducts)->paginate(4);

        Paginator::useBootstrap();
        return view('marketplace.product', compact('products', 'query'));
    }



    public function horizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.horizontal', compact('assets'));
    }
    public function dualhorizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-horizontal', compact('assets'));
    }
    public function dualcompact(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-compact', compact('assets'));
    }
    public function boxed(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed', compact('assets'));
    }
    public function boxedfancy(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed-fancy', compact('assets'));
    }

    /*
     * Pages Routs
     */
    public function billing(Request $request)
    {
        return view('special-pages.billing');
    }

    public function calender(Request $request)
    {
        $assets = ['calender'];
        return view('special-pages.calender', compact('assets'));
    }

    public function kanban(Request $request)
    {
        return view('special-pages.kanban');
    }

    public function pricing(Request $request)
    {
        return view('special-pages.pricing');
    }

    public function rtlsupport(Request $request)
    {
        return view('special-pages.rtl-support');
    }

    public function timeline(Request $request)
    {
        return view('special-pages.timeline');
    }

    /*
     * Widget Routs
     */
    public function widgetbasic(Request $request)
    {
        return view('widget.widget-basic');
    }
    public function widgetchart(Request $request)
    {
        $assets = ['chart'];
        return view('widget.widget-chart', compact('assets'));
    }
    public function widgetcard(Request $request)
    {
        return view('widget.widget-card');
    }

    /*
     * Maps Routs
     */
    public function google(Request $request)
    {
        return view('maps.google');
    }
    public function vector(Request $request)
    {
        return view('maps.vector');
    }

    /*
     * Auth Routs
     */
    public function signup(Request $request)
    {
        return view('auth.register');
    }
    public function confirmmail(Request $request)
    {
        return view('auth.confirm-mail');
    }
    public function lockscreen(Request $request)
    {
        return view('auth.lockscreen');
    }
    public function recoverpw(Request $request)
    {
        return view('auth.recoverpw');
    }
    public function userprivacysetting(Request $request)
    {
        return view('auth.user-privacy-setting');
    }

    /*
     * Error Page Routs
     */

    public function error404(Request $request)
    {
        return view('errors.error404');
    }

    public function error500(Request $request)
    {
        return view('errors.error500');
    }
    public function maintenance(Request $request)
    {
        return view('errors.maintenance');
    }

    /*
     * Form Page Routs
     */
    public function element(Request $request)
    {
        return view('forms.element');
    }

    public function wizard(Request $request)
    {
        return view('forms.wizard');
    }

    public function validation(Request $request)
    {
        return view('forms.validation');
    }

    /*
     * Table Page Routs
     */
    public function bootstraptable(Request $request)
    {
        return view('table.bootstraptable');
    }

    public function datatable(Request $request)
    {
        return view('table.datatable');
    }

    /*
     * Icons Page Routs
     */

    public function solid(Request $request)
    {
        return view('icons.solid');
    }

    public function outline(Request $request)
    {
        return view('icons.outline');
    }

    public function dualtone(Request $request)
    {
        return view('icons.dualtone');
    }

    public function colored(Request $request)
    {
        return view('icons.colored');
    }

    /*
     * Extra Page Routs
     */
    public function privacypolicy(Request $request)
    {
        return view('privacy-policy');
    }
    public function termsofuse(Request $request)
    {
        return view('terms-of-use');
    }
}
