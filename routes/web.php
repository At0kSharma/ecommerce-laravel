<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EditProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryimageController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\Homepage\HomeController;
use App\Http\Controllers\Product\PhotoController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Mail\MailController;
use App\Mail\InvoiceMail;


Auth::routes();
// Homepage controller
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/', [HomeController::class, 'index'])->name('');
// End homepage controller

//admin controllers 
Route::get('/admin',[AdminController::class, 'index'])->name('dashboard');

//edit product
Route::get('/edit/{id}/product',[EditProductController::class, 'index'])->name('index.product');
Route::post('/update/{id}/product',[EditProductController::class, 'product'])->name('update.product');
Route::post('/edit/{id}/product',[EditProductController::class, 'productimage'])->name('update.mainimage');

//edit property 
Route::get('/edit/{id}/property',[EditProductController::class, 'index'])->name('update.property');
Route::post('/edit/{id}/property',[EditProductController::class, 'property']);

//edit feature 
Route::get('/edit/{id}/feature',[EditProductController::class, 'index'])->name('update.feature');
Route::post('/edit/{id}/feature',[EditProductController::class, 'feature']);
Route::delete('/delete/{id}/feature',[EditProductController::class, 'destroy'])->name('delete.feature');

//edit quantity 
Route::get('/edit/{id}/quantity',[EditProductController::class, 'index'])->name('update.quantity');
Route::post('/edit/{id}/quantity',[EditProductController::class, 'quantity']);
Route::delete('/delete/{id}/quantity',[EditProductController::class, 'destroyquantity'])->name('delete.quantity');

//edit image 
Route::get('/edit/{id}/image',[PhotoController::class, 'index'])->name('update.image');
Route::post('/edit/{id}/image',[PhotoController::class, 'store']);
Route::delete('/delete/{id}/image',[PhotoController::class, 'destroy'])->name('delete.image');
//admin banner 
Route::get('/admin/banner',[BannerController::class, 'index'])->name('admin.banner');
Route::post('/admin/banner',[BannerController::class, 'store']);
Route::delete('/admin/{id}/banner',[BannerController::class, 'destroy'])->name('delete.banner');

//delete product
Route::delete('/admin/{id}/product',[AdminController::class, 'destroy'])->name('delete.product');

//admin 
Route::get('/addproduct',[AdminController::class, 'addproduct'])->name('addproduct');
Route::post('/addproduct',[AdminController::class, 'store']);
Route::get('/admin/edit/{id}/product',[AdminController::class, 'edit'])->name('edit.product');
Route::post('/admin/edit/{id}/product',[AdminController::class, 'edit']);

//orders
Route::get('/admin/orders/{status}',[OrdersController::class,'index'])->name('orders.index');
Route::post('/admin/order/{id}',[OrdersController::class,'store'])->name('orders.store');

// misc.
Route::get('admin/misc',[CategoryimageController::class,'index'])->name('misc.index');
Route::post('admin/misc',[CategoryimageController::class,'store'])->name('misc.store');


// product
Route::get('/product/{body}/{type}/{id}',[ProductController::class, 'index'])->name('product');


//rating
Route::post('/product/{product}/rating',[ProductController::class, 'rating'])->name('add.rating');

// cart
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart',[CartController::class,'store'])->name('cart.store');
// Route::post('/cart/saveforlater/{product}',[CartController::class,'saveforlater'])->name('cart.saveforlater');
Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');

// checkout
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout.index');
Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');
// Route::get('/payment',[CheckoutController::class,'payment'])->name('checkout.payment');
Route::get('/success/{id}',[CheckoutController::class,'success'])->name('checkout.success');

// shopping
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{body}/{type}',[ShopController::class,'subgroup'])->name('shop.subgroup');
Route::get('/shop/{type}',[ShopController::class,'type'])->name('shop.type');

// user
Route::get('/profile',[UserController::class,'index'])->name('user.index');

// address
Route::post('/profile/address',[AddressController::class,'store'])->name('address.store');
Route::delete('/profile/address/delete/{id}',[AddressController::class,'destroy'])->name('address.destroy');

// email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile/{order}/invoice',[MailController::class,'invoice'])->name('mail.invoice');