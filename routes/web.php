<?php

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

/*Route::get('/app', function () {
    return view('layouts.app');
});*/

Route::get('/','FrontendController@show_home');
Route::get('/about','FrontendController@show_about')->name('about');
Route::get('/blog','FrontendController@show_blog')->name('blog');
Route::get('/contact','FrontendController@show_contact')->name('contact');
Route::post('/message/store','FrontendController@messageStore')->name('message.store');
Route::get('blogs/details/{id}','FrontendController@blog_details');
Route::get('/product','FrontendController@show_product_details');
Route::post('/add_to_cart','CartController@index');
Route::get('/show_cart','CartController@show');
Route::get('/detele_to_card/{id}','CartController@item_destroy');
Route::post('/check','CartController@check');
Route::post('/update_cart','CartController@updateCart');
Route::get('/cash_checkout','CheckController@cashPayment');


Route::get('/checkout','CheckController@checkout')->middleware('auth:web');
Route::get('/user_panel','CheckController@userPanel')->middleware('auth:web');
Route::post('/proced_checkout','CheckController@proced_checkout')->middleware('auth:web');
Route::get('order/user_order/','CheckController@userOrder')->middleware('auth:web');
Route::get('order/user_order_details/{id}','CheckController@userOrderDetails')->middleware('auth:web');

Route::post('/cupon','CartController@applycupon');
Route::get('/paypal_checkout','PaypalPaymentController@index');

Route::post('/paypal_payment','PaypalPaymentController@paypal');
Route::get('/processPaypal','PaypalPaymentController@returnPaypal')->name('process.paypal');
Route::get('/cancelPaypal','PaypalPaymentController@cancelPaypal')->name('cancel.paypal');

Route::get('/stripe_checkout','StripePaymentController@index');
Route::post('/stripe_payment','StripePaymentController@store')->name('stripe.checkout');

Auth::routes();


/*Route::get('/home', 'HomeController@index');*/
Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>['auth:admin']],function(){
  //Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
	Route::resource('parts', 'BikePartController');
	Route::resource('pro_item', 'ProductItemController');
	Route::resource('pro_image', 'ProductImageController');
	Route::resource('title', 'FeatureTitleController');
	Route::resource('overview', 'FeatureOverviewController');
	Route::resource('promo_code', 'PromoCodeController');
	Route::resource('blogs', 'BlogController');
  Route::resource('about', 'AboutController');
  Route::resource('testimonal', 'TestimonialController');
  Route::resource('logo', 'LogoController');
  Route::resource('main_banners', 'MainBannerController');
  Route::get('/manage/contact','ManageController@manageContact');
  Route::get('/manage_orders','ManageController@manageOrders');
  Route::get('/manage_shipping','ManageController@manageShipping');
  Route::get('/manage_payments','ManageController@managePayments');
  Route::get('/order_details/{id}','ManageController@orderDetails');
  Route::get('/payment/refund/{id}','ManageController@paymentRefund');
  Route::get('/payment/refund/{id}','ManageController@paymentRefund');
  Route::post('/payment/refund/create','ManageController@paymentRefundCreate');
  Route::get('/payment/destroy/{id}','ManageController@paymentDestroy');
  Route::get('/shipping/destroy/{id}','ManageController@shippingDestroy');

  Route::get('/create/invoice/{id}','ManageController@createInvoice');

  /*Route::get('/payment/paypal_refund/{id}','RefundController@paypalPaymentRefund');
  Route::post('payment/paypal_refund/create','RefundController@paypalPaymentRefundCreate');*/

  Route::get('/manage/refund','ManageController@manageRefund');
  Route::get('order/status_change/{id}','StatusController@showStatusForm');
  Route::post('order/status/change','StatusController@changeOrderStatus');

  Route::get('parts/change_unactive/{id}','StatusController@unactiveParts');
  Route::get('parts/change_active/{id}','StatusController@activeParts');

  Route::get('blogs/change_unactive/{id}','StatusController@unactiveBlogs');
  Route::get('blogs/change_active/{id}','StatusController@activeBlogs');

  Route::get('testimonal/change_unactive/{id}','StatusController@unactiveTestimonial');
  Route::get('testimonal/change_active/{id}','StatusController@activeTestimonial');

  Route::get('contact/change_unactive/{id}','StatusController@activeContact');
  Route::get('contact/destroy/{id}','StatusController@destroy');


});

Route::post('/user/logout','Auth\LoginController@userLogout')->name('user.logout');
Route::prefix('admin')->group(function (){
	// Dashboard route
   Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
    // Login routes
   Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
   Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    // Logout route
   Route::post('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    // Register routes
   Route::get('/register','Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
   Route::post('/register','Auth\AdminRegisterController@register')->name('admin.register.submit');
    // Password reset routes
   Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
   Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
   Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
   Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('admin.password.update');
  Route::get("/{path}", "Admin\StatusController@serve")->where('path', '.+');
});

/*Route::get("{path}", "CheckController@serve")->where('path', '.+');*/


