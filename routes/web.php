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


///// Frontend
Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/home', 'App\Http\Controllers\HomeController@index');
Route::post('/search', 'App\Http\Controllers\HomeController@search');
Route::get('/my_order', 'App\Http\Controllers\HomeController@my_order');
Route::get('/view_processing/{orderid}', 'App\Http\Controllers\HomeController@view_processing');
Route::get('/view_delivered/{orderid}', 'App\Http\Controllers\HomeController@view_delivered');
Route::get('/view_cancel/{orderid}', 'App\Http\Controllers\HomeController@view_cancel');
Route::get('/cancel_order/{orderid}', 'App\Http\Controllers\HomeController@cancel_order');
Route::get('/edit_customer/{customer_id}', 'App\Http\Controllers\HomeController@edit_customer');
Route::post('/update_customer/{customer_id}', 'App\Http\Controllers\HomeController@update_customer'); 
Route::get('/change_password/{customer_id}', 'App\Http\Controllers\HomeController@change_password'); 
Route::post('/update_password/{customer_id}', 'App\Http\Controllers\HomeController@update_password'); 
Route::get('/forget-pass', 'App\Http\Controllers\HomeController@forget_password');
Route::post('/recover_pass', 'App\Http\Controllers\HomeController@recover_password');
Route::get('/update_new_pass', 'App\Http\Controllers\HomeController@update_new_password');
Route::post('/reset_new_pass', 'App\Http\Controllers\HomeController@reset_new_password'); 

    // Quản lí đơn hàng
    Route::get('/manage_order', 'App\Http\Controllers\AdminController@manage_order');   
    Route::get('/view_order/{orderId}', 'App\Http\Controllers\AdminController@view_order');
    Route::get('/edit_order/{orderId}', 'App\Http\Controllers\AdminController@edit_order');
    Route::get('/delete_order/{orderId}', 'App\Http\Controllers\AdminController@delete_order');
    Route::post('/update-order/{orderId}', 'App\Http\Controllers\AdminController@update_order');
    Route::post('/search_order', 'App\Http\Controllers\AdminController@search_order');


    // Quản lý khách hàng
    Route::get('/manage_customer', 'App\Http\Controllers\AdminController@manage_customer');   
    Route::get('/delete_customer/{customerId}', 'App\Http\Controllers\AdminController@delete_customer');
    
///// Backend

Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::get('/forget-password', 'App\Http\Controllers\AdminController@forget_password');
Route::post('/recover_password', 'App\Http\Controllers\AdminController@recover_password');
Route::get('/update_new_password', 'App\Http\Controllers\AdminController@update_new_password');
Route::post('/reset_new_password', 'App\Http\Controllers\AdminController@reset_new_password');  
   
// Danh mục sản  phẩm
    
    Route::get('/add-category-product', 'App\Http\Controllers\categoryproduct@add_category_product');
    Route::post('/save-category-product', 'App\Http\Controllers\categoryproduct@save_category_product');
    Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\categoryproduct@unactive_category_product');
    Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\categoryproduct@active_category_product');
    Route::get('/edit_cate_product/{category_product_id}', 'App\Http\Controllers\categoryproduct@edit_category_product');
    Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\categoryproduct@update_category_product');
    
    Route::get('/delete_cate_product/{category_product_id}', 'App\Http\Controllers\categoryproduct@delete_category_product');

    //Product 
    Route::get('/product', 'App\Http\Controllers\Productcontroller@add_cate_product');
    Route::post('/save-product', 'App\Http\Controllers\Productcontroller@add_product');
    Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\Productcontroller@unactive_product');
    Route::get('/active-product/{product_id}', 'App\Http\Controllers\Productcontroller@active_product');
    Route::get('/delete_product/{product_id}', 'App\Http\Controllers\Productcontroller@delete_product');
    Route::get('/edit_product/{product_id}', 'App\Http\Controllers\Productcontroller@edit_product');
    Route::post('/update-product/{product_id}', 'App\Http\Controllers\Productcontroller@update_product');
    Route::post('/search_product_admin', 'App\Http\Controllers\Productcontroller@search_product_admin');

    // Discount
    Route::get('/discount', 'App\Http\Controllers\Productcontroller@discount');
    Route::post('/save_discount', 'App\Http\Controllers\Productcontroller@save_discount');
    Route::get('/unactive-discount/{disocunt_id}', 'App\Http\Controllers\Productcontroller@unactive_discount');
    Route::get('/active-discount/{discount_id}', 'App\Http\Controllers\Productcontroller@active_discount');
    Route::get('/delete_discount/{discount_id}', 'App\Http\Controllers\Productcontroller@delete_discount');
    Route::get('/edit_discount/{discount_id}', 'App\Http\Controllers\Productcontroller@edit_discount');
    Route::post('/update-discount/{discount_id}', 'App\Http\Controllers\Productcontroller@update_discount');

    // ảnh chi tiết imagesdetail
    Route::get('/imagesdetail/{product_id}', 'App\Http\Controllers\Productcontroller@imagesdetail');
    Route::post('/select-gallery', 'App\Http\Controllers\Productcontroller@select_gallery');
    Route::post('/insert_imagesdetail/{imagesdetail_id}', 'App\Http\Controllers\Productcontroller@insert_imagesdetail');
    Route::post('/update-gallery-name', 'App\Http\Controllers\Productcontroller@update_gallery_name');
    Route::post('/delete-gallery-name', 'App\Http\Controllers\Productcontroller@delete_gallery_name');
    Route::post('/update-gallery-image', 'App\Http\Controllers\Productcontroller@update_gallery_image');

    // danh-muc-san-pham
    
    Route::get('/category_product/{category_id}', 'App\Http\Controllers\categoryproduct@show_category_product');
     // Chi-Tiết-Sản-Phẩm
     Route::get('/product_details/{product_id}', 'App\Http\Controllers\Productcontroller@product_details');
    //  Route::post('/save-cmmt/{product_id}', 'App\Http\Controllers\Productcontroller@save_cmmt');
     Route::post('/review_rating', 'App\Http\Controllers\Productcontroller@review_rating');
    
     // Contact
     Route::get('/contact', 'App\Http\Controllers\HomeController@contact');
     // Thêm giỏ hàng
     Route::post('/add_cart', 'App\Http\Controllers\Cartcontroller@add_cart');
     Route::post('/save-cart', 'App\Http\Controllers\Cartcontroller@save_cart');
     Route::get('/show_cart', 'App\Http\Controllers\Cartcontroller@show_cart');
     Route::get('/cart', 'App\Http\Controllers\Cartcontroller@cart');
     Route::get('/detele-to-cart/{rowId}', 'App\Http\Controllers\Cartcontroller@delete_cart');
     Route::post('/update_product', 'App\Http\Controllers\Cartcontroller@update_product');
        
     //Check_out 
     Route::get('/login_customer', 'App\Http\Controllers\Checkoutcontroller@login_customer');
     Route::post('/register_customer', 'App\Http\Controllers\Checkoutcontroller@register_customer'); 
     Route::get('/checkout', 'App\Http\Controllers\Checkoutcontroller@checkout');
     Route::post('/checkout_buy', 'App\Http\Controllers\Checkoutcontroller@checkout_buy');
     // continue_shopping
     Route::get('/continue_shopping', 'App\Http\Controllers\Checkoutcontroller@continue_shopping');
     // Billing_checkout
     Route::post('/billing_checkout', 'App\Http\Controllers\Checkoutcontroller@billing_checkout');
     Route::get('/detele-to-billing/{billing_id}', 'App\Http\Controllers\Checkoutcontroller@delete_billing');
     //Đăng xuất
     Route::get('/logout_customer', 'App\Http\Controllers\Checkoutcontroller@logout_customer');
     //Đăng Nhập
     Route::post('/login', 'App\Http\Controllers\Checkoutcontroller@login');

     // Pay
     Route::post('/order_place', 'App\Http\Controllers\Checkoutcontroller@order_place'); 
     
    