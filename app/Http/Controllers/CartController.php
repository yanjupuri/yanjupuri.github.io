<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderHistory;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = auth()->user();
        $product = Products::find($request->productId);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $totalQuantityInCart = Cart::where('product_id', $request->productId)
                                ->where('user_id', $user->id)
                                ->count();
    
        if ($product->quantity > $totalQuantityInCart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $request->productId;
            $cart->save();
    
            return response()->json(['message' => 'Product added to cart successfully'], 200);
        } else {
            return response()->json(['error' => 'Insufficient product quantity'], 400);
        }
    }
    

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('productId');
    
        $user = auth()->user();
        $cartItem = $user->cart()->where('product_id', $productId);
    
        if ($cartItem) {
            $cartItem->delete();
        }
    
        return response()->json([
            'message' => 'Product removed from cart successfully',
            'redirect' => route('cart'),
        ]);
    }
    

    public function removeOneFromCart(Request $request)
    {
        $productId = $request->input('productId');

        $user = auth()->user();
        $cartItem = $user->cart->where('product_id', $productId)->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return response()->json([
            'message' => 'One product removed from cart successfully',
            'redirect' => route('cart'),
        ]);
    }

    public function cashInvoice(Request $request)
    {
        $full_name = auth()->user()->full_name;
        $cartItemIds = json_decode($request->input('checkedItems'));

        $cartItems = Cart::whereIn('product_id', $cartItemIds)->get();
        $productIds = $cartItems->pluck('product_id')->toArray();
    
        $products = Products::whereIn('id', $productIds)->get();
    
        $productQuantities = array_count_values($productIds);
    
        foreach ($products as $product) {
            $product->quantity = $productQuantities[$product->id];
        }
    
        $date = Carbon::now()->timezone('Asia/Manila')->format('F d, Y h:iA');
        $dateWithoutSpaces = Carbon::now()->timezone('Asia/Manila')->format('mdYHism');

        $pdf = Pdf::loadView('marketplace.cash-invoice', compact('products', 'full_name'));
        $pdf->setPaper('A4', 'portrait');
    
        return $pdf->download("Invoice - $dateWithoutSpaces.pdf");
    }

    public function payPalInvoice(Request $request)
    {
        $orderId = $request->orderId;
        $products = OrderHistory::where('id', $orderId)->get();
    
        $full_name = auth()->user()->full_name;
    
        $date = Carbon::now()->timezone('Asia/Manila')->format('F d, Y h:iA');
        $dateWithoutSpaces = Carbon::now()->timezone('Asia/Manila')->format('mdYHism');
    
        $pdf = PDF::loadView('marketplace.invoice', compact('products', 'full_name'));
        $pdf->setPaper('A4', 'portrait');
    
        return $pdf->download("Invoice - $dateWithoutSpaces.pdf");
    }

    // public function payPalInvoice(Request $request)
    // {
    //     $full_name = auth()->user()->full_name;
    //     $cartItemIds = json_decode($request->input('checkedItems'));

    //     $cartItems = Cart::whereIn('product_id', $cartItemIds)->get();
    //     $productIds = $cartItems->pluck('product_id')->toArray();
    
    //     $products = Products::whereIn('id', $productIds)->get();
    
    //     $productQuantities = array_count_values($productIds);
    
    //     foreach ($products as $product) {
    //         $product->quantity = $productQuantities[$product->id];
    //     }
    
    //     $date = Carbon::now()->timezone('Asia/Manila')->format('F d, Y h:iA');
    //     $dateWithoutSpaces = Carbon::now()->timezone('Asia/Manila')->format('mdYHism');

    //     $pdf = Pdf::loadView('marketplace.invoice', compact('products', 'full_name'));
    //     $pdf->setPaper('A4', 'portrait');
    
    //     return $pdf->download("Invoice - $dateWithoutSpaces.pdf");
    // }

    public function addOrderHistory(Request $request)
    {
        $user = auth()->user();
        $history = OrderHistory::create([
            'product_id' => $request->product_id,
            'order_id' => $request->orderID,
            'user_id' => $user->id,
            'product_name' => $request->product_name,
            'purchased_date' => $request->purchased_date,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'base_price' => $request->base_price,
            'mode_of_payment' => $request->MOP
        ]);

        // dd($request->_token);

        // $history = new OrderHistory();
        // $history->user_id = $user_id;
        // $history->product_name = $request->product_name;
        // $history->purchased_date = $request->purchased_date;
        // $history->total_amount = $request->total_amount;
        // $history->status = $request->status;
        // $history->save();

        if ($history) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
