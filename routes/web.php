<?php

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
//frontend
use App\Http\Controllers\HomeController;
use App\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

///////////Home ////////////
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
Route::get('/admin-login','HomeController@login');
Route::get('/huong-dan-dat-hang','HomeController@huong_dan');
Route::get('/chinh-sach','HomeController@chinh_sach');
Route::get('/thong-tin','HomeController@thong_tin');
Route::get('/chi-nhanh','HomeController@chi_nhanh');
Route::get('/product-view','HomeController@product_view');
Route::get('/show-order/{customer_id}','HomeController@show_order');
Route::post('/del-order/{order_code}','HomeController@del_order');


//danh muc san pham//////
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/chi-tiet-san-pham/{pro_encrypted}','ProductController@detail_product');

// Send Mail/////////
Route::get('/send-mail','HomeController@send_mail');

// FaceBook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//backend

Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//Category Product

Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{cate_encrypted}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{cate_encrypted}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/active-category-product/{cate_encrypted}','CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{cate_encrypted}','CategoryProduct@unactive_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

Route::post('/export-csv','CategoryProduct@export_csv');
Route::post('/import-csv','CategoryProduct@import_csv');

//Material Product

Route::get('/add-material','MaterialProduct@add_material');
Route::get('/edit-material/{material_id}','MaterialProduct@edit_material');
Route::get('/delete-material/{material_id}','MaterialProduct@delete_material');
Route::get('/all-material','MaterialProduct@all_material');

Route::get('/active-material/{material_id}','MaterialProduct@active_material');
Route::get('/unactive-material/{material_id}','MaterialProduct@unactive_material');

Route::post('/save-material','MaterialProduct@save_material');
Route::post('/update-material/{material_id}','MaterialProduct@update_material');

///Material Details
Route::get('/add-material-details','MaterialProduct@add_material_details');
Route::get('/material-details/{pro_encryted}','MaterialProduct@material_details');
Route::post('/save-material-details','MaterialProduct@save_material_details');

Route::post('/show-material-details','MaterialProduct@show_material_details');
Route::post('/update-material-details','MaterialProduct@update_material_details');
Route::get('/delete-details/{material_details_id}','MaterialProduct@delete_details');

// Product

Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{pro_encryted}','ProductController@edit_product');
Route::get('/delete-product/{pro_encryted}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/active-product/{pro_encryted}','ProductController@active_product');
Route::get('/unactive-product/{pro_encryted}','ProductController@unactive_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{pro_encryted}','ProductController@update_product');

Route::post('/export-product','ProductController@export_product');
Route::post('/import-product','ProductController@import_product');

// Cart

Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');

/// Cart AJAX
Route::get('/gio-hang','CartController@gio_hang');
Route::post('/update-cart','CartController@update_cart');
Route::get('/del-product/{session_id}','CartController@del_product');
Route::get('/del-all-product','CartController@del_all_product');

/// Coupon
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/insert-coupon','CouponController@insert_coupon');
Route::post('/save-coupon','CouponController@save_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');

///Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

Route::get('/del-fee','CheckoutController@del_fee');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');

///Order

Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/update-status/{order_code}','OrderController@update_status');
Route::get('/print-order/{checkout_code}','OrderController@print_order');

///Delivery
Route::get('/delivery','DeliveryController@delivery');
Route::get('/all-delivery','DeliveryController@all_delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');
Route::get('/delete-delivery/{fee_id}','DeliveryController@delete_delivery');

//// Customer
Route::get('/manage-customer','CustomerController@manage_customer');
Route::get('/active-customer/{customer_id}','CustomerController@active_customer');
Route::get('/unactive-customer/{customer_id}','CustomerController@unactive_customer');


/////// Banner
Route::get('/manage-banner','BannerController@manage_banner');
Route::get('/add-banner','BannerController@add_banner');
Route::post('/insert-banner','BannerController@insert_banner');
Route::get('/active-banner/{banner_id}','BannerController@active_banner');
Route::get('/unactive-banner/{banner_id}','BannerController@unactive_banner');
Route::get('/delete-banner/{banner_id}','BannerController@delete_banner');
Route::get('/edit-banner/{banner_id}','BannerController@edit_banner');
Route::post('/update-banner/{banner_id}','BannerController@update_banner');

//// Auth Role
// Route::get('/register-auth','AuthController@register_auth');
// Route::get('/login-auth','AuthController@login_auth');
// Route::get('/logout-auth','AuthController@logout_auth');

// Route::post('/register','AuthController@register');
// Route::post('/login','AuthController@login');

/////USER
Route::get('/all-user','UserController@all_user');
Route::get('/del-user/{admin_id}','UserController@del_user');
Route::get('/add-roles/{admin_id}','UserController@add_roles');
Route::get('/del-roles/{admin_id}','UserController@del_roles');
Route::post('/save-roles/{admin_id}','UserController@save_roles');
Route::get('/show-info/{admin_id}','UserController@show_info');
Route::post('/change-info/{admin_id}','UserController@change_info');
Route::get('/edit-info/{admin_id}','UserController@edit_info');

Route::get('/insert-user','UserController@insert_user');
Route::post('/save-user','UserController@save_user');

Route::post('/export-user','UserController@export_user');
Route::post('/import-user','UserController@import_user');
