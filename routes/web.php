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
/*front-end*/
Route::get('/', 'HomeController@index');
Route::get('/trang-chu','HomeController@index');
/*end front-end*/
/*backend*/
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin-dashboard', 'AdminController@dashboard');
/*backend*/


/*category*/
Route::get('/add-categoryproduct', 'CategoryProductController@create')->name('add-categoryproduct');
Route::get('/all-categoryproduct', 'CategoryProductController@index');
Route::get('/active-category-product/{category_product_id}', 'CategoryProductController@active');
Route::get('/unactive-category-product/{category_product_id}', 'CategoryProductController@unactive');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProductController@destroy');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProductController@edit');

Route::post('/save-category-product', 'CategoryProductController@store');
Route::post('/update-category-product/{category_product_id}', 'CategoryProductController@update');
/*category*/

/*brand*/
Route::get('/add-brandproduct', 'BrandProductController@create')->name('add-brandproduct');
Route::get('/all-brandproduct', 'BrandProductController@index');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProductController@active');
Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProductController@unactive');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProductController@destroy');
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProductController@edit');

Route::post('/save-brand-product', 'BrandProductController@store');
Route::post('/update-brand-product/{brand_product_id}', 'BrandProductController@update');
/*brand*/

/*product*/
Route::get('/add-product', 'ProductController@create')->name('add-product');
Route::get('/all-product', 'ProductController@index');
Route::get('/active-product/{product_id}', 'ProductController@active');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive');
Route::get('/delete-product/{product_id}', 'ProductController@destroy');
Route::get('/edit-product/{product_id}', 'ProductController@edit');


Route::post('/save-product', 'ProductController@store');
Route::post('/update-product/{product_id}', 'ProductController@update');
/*product*/
/*dm-sản phẩm-trang chủ*/
Route::get('/danhmuc-sanpham/{product_id}', 'CategoryProductController@show_category_home');
Route::get('/danhmuc-thuonghieu/{product_id}', 'CategoryProductController@show_brand_home');
Route::get('/chitietsanpham/{product_id}', 'ProductController@show');
/*dm-sản phẩm-trang chủ*/

/**CHC */
Route::get('/ketquaxetnghiem/{benhnhan_id}', 'KQXetNghiemController@show');



