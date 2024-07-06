<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GiftCardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;

Route::get('/login',[CustomerController::class,'index'])->name('customer.login');
Route::get('/logout',[CustomerController::class,'logout'])->name('customer.logout');
Route::post('/authenticate',[CustomerController::class,'authenticate'])->name('customer.authenticate');
Route::get('/register',[CustomerController::class,'register'])->name('customer.register');
Route::post('/customer/process-register',[CustomerController::class,'processRegister'])->name('customer.processRegister');
Route::get('/customer/change-password', [CustomerController::class, 'showChangePasswordForm'])->name('customer.change-password');
Route::post('/customer/change-password', [CustomerController::class, 'changePassword'])->name('customer.change-password.post');
Route::get('/customer/orders', [CustomerController::class, 'orderDetails'])->name('customer.orders');



Route::get('send-email',[EmailController::class,'sendEmail'])->name('send.email');

Route::get('/admin/orders',[OrderController::class,'index'])->name('order.index');
Route::post('admin/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::put('order/{orderId}/status', [OrderController::class, 'status'])->name('order.status');
Route::get('/admin/orders/details/{orderId}',[OrderController::class,'orderDetails'])->name('order.details');


Route::get('/cart/payment',[PaymentController::class,'payment'])->name('front.payment');
Route::post('/cart/payment/success',[PaymentController::class,'successpayment'])->name('front.success');
Route::get('/cart/payment/success/page', [PaymentController::class, 'successPage'])->name('front.success.page');

// Route::get('/cart/summary', [PaymentController::class, 'cartSummary'])->name('cart.summary');
// Route::get('/cart/payment', [PaymentController::class, 'showPaymentPage'])->name('front.pay');

Route::get('/account/order/review',[FrontController::class,'review'])->name('front.review');
Route::get('/cart/address',[AddressController::class,'address'])->name('front.address');

Route::post('/cart/address',[AddressController::class,'store'])->name('front.address.store');
Route::post('/cart/address/save',[AddressController::class,'saveAddress'])->name('front.address.save');

Route::post('/save-rating/{productId}',[FrontController::class,'saveRating'])->name('front.saveRating');

Route::get('/cart',[FrontController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart/{id}', [FrontController::class, 'addTo'])->name('front.addToCart');
Route::get('/account',[FrontController::class,'account'])->name('front.account');
Route::get('/addtocart/detail/{product}/',[FrontController::class,'addToCart'])->name('front.addtocart');
Route::get('/addtocart/detail/{product}/',[FrontController::class,'updatedetail'])->name('update.detail');
Route::get('/new-route', [FrontController::class, 'newRoute'])->name('front.newRoute');
Route::get('/home',[FrontController::class,'index'])->name('front.home');
Route::get('/detail',[FrontController::class,'detail'])->name('front.detail');
Route::delete('/remove-from-cart/{id}', [FrontController::class, 'removeFromCart'])->name('front.removeFromCart');
Route::get('/listing',[FrontController::class,'list'])->name('front.list');
Route::get('/sucess/page',[FrontController::class,'success'])->name('front.successPage');
Route::get('/',[FrontController::class,'update']);

Route::get('/home/giftcard/{id}',[GiftCardController::class,'giftcard'])->name('front.giftcard');
Route::get('/admin/giftcard',[GiftCardController::class,'index'])->name('admin.giftcard');
// routes/web.php
Route::post('/giftcard/check', [GiftCardController::class, 'checkGiftCard'])->name('giftcard.check');
Route::post('/giftcard/update', [GiftCardController::class, 'updateGiftCard'])->name('giftcard.update');

Route::get('/admin/giftcard/create',[GiftCardController::class,'create'])->name('giftcard.create');
Route::post('/giftcard/store', [GiftCardController::class, 'store'])->name('giftcard.store.front');
Route::delete('/admin/giftcard/{giftcard}',[GiftcardController::class,'destroy'])->name('giftcard.destroy');

Route::get('/giftcard',[GiftCardController::class,'view']);

Route::post('/admin/change-password/store',[AdminController::class,'processChangePassword'])->name('admin.processChangePassword');
Route::get('/admin/change-password',[AdminController::class,'showChangePasswordForm'])->name('admin.showChangePasswordForm');
Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
Route::get('/admin/logout',[LoginController::class,'logout'])->name('admin.logout');


Route::get('/admin/login',[LoginController::class,'index'])->name('admin.login');
Route::post('/admin/authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');
Route::get('/admin/register',[LoginController::class,'register'])->name('admin.register');
Route::post('/admin/process-register',[LoginController::class,'processRegister'])->name('admin.processRegister');


Route::get('/admin/product/index',[ProductController::class,'index'])->name('product.index');
Route::get('/admin/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/admin/products',[ProductController::class,'store'])->name('product.store');
Route::get('/admin/product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
Route::put('/admin/product/{product}',[ProductController::class,'update'])->name('product.update');
Route::delete('/admin/product/{product}',[ProductController::class,'destroy'])->name('product.destroy');
// In your routes/web.php
Route::post('/products/{productId}/pin/{categoryId}', [ProductController::class,'pinProduct'])->name('products.pin');
Route::post('/products/{productId}/unpin/{categoryId}', [ProductController::class,'unpinProduct'])->name('products.unpin');
Route::get('/products/paginate', [ProductController::class, 'paginate'])->name('products.paginate');
Route::get('/products/filter', [ProductController::class, 'filterProducts'])->name('products.filter');

Route::get('/admin/product/ratings',[ProductController::class,'productRatings'])->name('product.productRating');
Route::get('/admin/product/change-rating',[ProductController::class,'changeRatingSatus'])->name('product.changeRatingSatus');
Route::get('/product/{product}/sort-reviews', [ProductController::class,'sortReviews'])->name('product.sort.reviews');


//categories and sub-categories
Route::get('/admin/categories/list',[AdminCategoriesController::class,'list'])->name('categories.index');
Route::get('/admin/categories/add',[AdminCategoriesController::class,'addCategory'])->name('categories.add');
Route::post('/admin/categories/store',[AdminCategoriesController::class,'store'])->name('categories.store');
Route::get('/admin/categories/{category}/edit',[AdminCategoriesController::class,'editCategory'])->name('categories.edit');
Route::post('/admin/categories/{category}/update',[AdminCategoriesController::class,'updateCategory'])->name('categories.update');
Route::delete('/admin/category/{category}',[AdminCategoriesController::class,'deleteCategory'])->name('categories.delete');
Route::get('/admin/categories/{categoryId}/products',[AdminCategoriesController::class,'getProducts'])->name('categories.products');
Route::post('/categories/{id}/assign-products', [AdminCategoriesController::class,'assignProducts'])->name('categories.assignProducts');
Route::get('/category/{subcategory}', [AdminCategoriesController::class, 'show'])->name('category.show');
Route::post('/categories/{categoryId}/update-positions', [AdminCategoriesController::class, 'updatePositions'])->name('categories.updatePositions');


Route::get('/orders/{orderId}/download-pdf', [PdfController::class, 'downloadPdf'])->name('order.downloadPdf');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleController::class, 'callbackGoogle']);

