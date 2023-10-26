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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('/');

Route::get('/demo', function () {
   return view('demo');
});

Route::match(['get','post'],'/start_tour', 'HomeController@start_tour');
Route::match(['get','post'],'/signin', 'HomeController@signin');
Route::match(['get','post'],'/home/get_poi/{tour_id}/{id}', 'HomeController@get_poi');
Route::match(['get','post'],'/home/check_password', 'HomeController@check_password');

Route::group(['middleware' => 'auth'], function () {

Route::prefix('admin')->group(function () {
    Route::get('/', 'admin\AdminController@index');
    Route::match(['get','post'],'/profile', 'admin\AdminController@profile');
 
    Route::prefix('users')->group(function () {
	    Route::get('/', 'admin\UsersController@index');
	    Route::match(['get','post'],'/create', 'admin\UsersController@create');
	    Route::match(['get','post'],'/{user}/update', 'admin\UsersController@update');
	    Route::match(['get','post'],'/{user}/delete', 'admin\UsersController@delete');
	});
	Route::prefix('tours')->group(function () {
	    Route::get('/', 'admin\ToursController@index');
	    Route::match(['get','post'],'/create', 'admin\ToursController@create');
	    Route::match(['get','post'],'/{tour}/update', 'admin\ToursController@update');
	    Route::match(['get','post'],'/{tour}/delete', 'admin\ToursController@delete');
	    // Route::get('/{tour}/add_variation', 'admin\ToursController@add_variation');
	    
	    /*Variation*/
	    Route::match(['get','post'],'{tour}/variation_list', 'admin\ToursController@variation_list');
	    Route::match(['get','post'],'{tour}/add_variation', 'admin\ToursController@add_variation');
	    Route::match(['get','post'],'{variation}/edit_variation', 'admin\ToursController@edit_variation');
	    Route::match(['get','post'],'{variation}/delete_variation', 'admin\ToursController@delete_variation');


	    /*POI*/
	    Route::match(['get','post'],'{tour}/poi_list', 'admin\ToursController@poi_list');
	    Route::match(['get','post'],'{tour}/add_poi', 'admin\ToursController@add_poi');
	    Route::match(['get','post'],'{poi}/edit_poi', 'admin\ToursController@edit_poi');
	    Route::match(['get','post'],'{poi}/delete_poi', 'admin\ToursController@delete_poi');
	    Route::match(['get','post'],'default_poi', 'admin\ToursController@update_default_poi');

	    // unique password 
	    Route::match(['get','post'],'/unique_password', 'admin\ToursController@unique_password');

	    Route::match(['get','post'],'/password', 'admin\ToursController@password');
	    Route::match(['get','post'],'/{tour}/password_list', 'admin\ToursController@password_list');
	    Route::match(['get','post'],'{tour}/add_password', 'admin\ToursController@add_password');
	    Route::match(['get','post'],'{password}/edit_password', 'admin\ToursController@edit_password');
	    // Route::match(['get','post'],'{password}/delete_password', 'admin\ToursController@delete_password');
	    Route::match(['get','post'],'/delete_password', 'admin\ToursController@delete_password');

	});
    Route::get('/update_password

    	', 'admin\ToursController@update_password');
    // Route::match(['get','post'],'/login', 'admin\LoginController@index');

});

});
