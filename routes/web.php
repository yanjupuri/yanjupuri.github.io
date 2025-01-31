<?php

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RevenueController;
use Illuminate\Support\Facades\Artisan;
// Packages
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::get('/down-server', function () {
    Artisan::call('down');
});

Route::get('/up-server', function () {
    Artisan::call('up');
});

Route::get('/migration', function () {
    $exitCode = Artisan::call('migrate');

    if ($exitCode === 0) {
        return 'Migrations executed successfully.';
    } else {
        return 'Migrations failed. Check your logs for more information.';
    }
});


/**
 * UI Route
 */
Route::get('/loading', [HomeController::class, 'loading'])->name('loading');

// Dashboard Routes
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('adminDashboard', [HomeController::class, 'adminDashboard'])->name('adminDashboard');
    // Permission Module
    Route::get('/role-permission', [RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    // Users Module
    Route::resource('users', UserController::class);


    Route::group(['prefix' => 'products'], function () {
        Route::get('/productslist', [ProductController::class, 'index'])->name('admin.products');
        Route::get('edit/{id}', [ProductController::class, 'show'])->name('dashboard.products.update');
        Route::post('addproduct', [ProductController::class, 'store'])->name('products.add');
        Route::post('deleteproduct/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::patch('updateproduct', [ProductController::class, 'update'])->name('products.update');
        Route::get('/products/details', [ProductController::class, 'getProductDetails'])->name('products.details');
    });

    Route::post('/add-revenue', [RevenueController::class, 'addRevenue'])->name('add.revenue');
    Route::post('/mark-as-done', [RevenueController::class, 'markAsDone'])->name('mark-as-done');
    Route::get('/fetch-order-history/{userId}', [RevenueController::class, 'fetchOrderHistory'])->name('fetch.order');

    Route::group(['prefix' => 'services'], function () {
        Route::get('/services', [ServiceController::class, 'index'])->name('admin.services');
        Route::get('edit/{id}', [ServiceController::class, 'show'])->name('dashboard.services.update');
        Route::post('addservice', [ServiceController::class, 'store'])->name('services.add');
        Route::post('deleteservice/{id}', [ServiceController::class, 'delete'])->name('services.delete');
        Route::patch('updateservice', [ServiceController::class, 'update'])->name('services.update');
        Route::get('/services/details', [ServiceController::class, 'getServiceDetails'])->name('services.details');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/userslist', [UserController::class, 'admin'])->name('admin.users');
        Route::get('edit/{id}', [UserController::class, 'show'])->name('users.edit');
        Route::match (['get', 'patch'], 'update', [UserController::class, 'update'])->name('users.update');
        Route::post('deleteuser/{id}', [UserController::class, 'destroy'])->name('users.delete');

        // shopping cart
        Route::get('cart', [HomeController::class, 'cart'])->name('cart');
        Route::get('history', [HomeController::class, 'orderHistory'])->name('history');
        Route::post('/order/history', [CartController::class, 'addOrderHistory'])->name('create.order.history');
        Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::post('/remove-one-from-cart', [CartController::class, 'removeOneFromCart'])->name('remove-one-from-cart');
        Route::get('/cash-invoice', [CartController::class, 'cashInvoice'])->name('print.cash.invoice');
        Route::get('/paypal-invoice', [CartController::class, 'payPalInvoice'])->name('print.paypal.invoice');
    });

    Route::group(['prefix' => 'review'], function () {
        Route::post('/addreview', [ReviewController::class, 'store'])->name('reviews.store');
        Route::patch('/updatereview', [ReviewController::class, 'update'])->name('reviews.update');
        Route::patch('/update', [ReviewController::class, 'updateReview'])->name('reviews.updatereview');
        Route::get('/review/details', [ReviewController::class, 'getReviewDetails'])->name('reviews.details');
    });

    Route::group(['prefix' => 'admins'], function () {
        Route::get('reviews', [HomeController::class, 'adminReviews'])->name('admin.reviews');
        Route::get('aboutUs', [AboutController::class, 'index'])->name('admin.aboutus');
        Route::post('addabout', [AboutController::class, 'store'])->name('admin.addaboutus');
        Route::post('deleteabout/{id}', [AboutController::class, 'delete'])->name('admin.deleteaboutus');
        Route::get('/about/details', [AboutController::class, 'getAboutDetails'])->name('admin.aboutdetails');
        Route::patch('updateproduct', [AboutController::class, 'update'])->name('admin.updateabout');
    });

});


Route::group(['prefix' => 'offers'], function () {
    Route::get('products', [HomeController::class, 'products'])->name('products');
    Route::get('services', [HomeController::class, 'services'])->name('services');
});

Route::match(['get', 'post'], '/filtered-review', [HomeController::class, 'filteredReview'])->name('reviews.filtered');
// Route::post('/filtered-review', [HomeController::class, 'filteredReview'])->name('reviews.filtered');
Route::get('show-products', [ProductController::class, 'showById'])->name('products.show');
Route::get('show-services', [ServiceController::class, 'showById'])->name('services.show');
Route::get('show-team-details', [UserController::class, 'showById'])->name('team.show');
Route::get('payments', [HomeController::class, 'payments'])->name('payments');
Route::match(['get', 'post'], 'reviews', [HomeController::class, 'reviews'])->name('reviews');
// Route::get('reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('aboutUS', [HomeController::class, 'aboutUS'])->name('aboutUS');
Route::get('team', [HomeController::class, 'team'])->name('team');
Route::get('storage/profile_pictures/{filename}', [StorageController::class, 'getProfilePicture'])->name('profile_picture');
Route::get('storage/product_images/{filename}', [StorageController::class, 'getProduct'])->name('product_image');
Route::get('storage/services_images/{filename}', [StorageController::class, 'getService'])->name('service_image');
Route::get('storage/review_pictures/{filename}', [StorageController::class, 'getReview'])->name('review_image');
Route::get('storage/about_images/{filename}', [StorageController::class, 'getAboutUs'])->name('about_image');

Route::group(['prefix' => 'emails'], function () {
    // Route::get ('/',[MailController::class,'mailform']);
    Route::post('/send-mail', [MailController::class, 'sendMail'])->name('send_mail');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function () {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});

//Error Page Route
Route::group(['prefix' => 'errors'], function () {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});
