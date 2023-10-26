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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::match(['get','post'],'admin','Admin\adminController@login');
Route::match(['get','post'],'dashboard','Admin\adminController@dashboard');
Route::match(['get','post'],'/admin/users/create','Admin\adminController@createuser');
Route::match(['get','post'],'/admin/logout','Admin\adminController@logout');
Route::match(['get','post'],'allusers','Admin\adminuserController@allusers');
Route::match(['get','post'],'updateuser/{id}','Admin\adminuserController@updateuser');
Route::match(['get','post'],'deleteuser/{id}','Admin\adminuserController@destroy');
Route::match(['get','post'],'viewuser/{id}','Admin\adminuserController@viewuser');
Route::get('filter/user','Admin\adminuserController@filter');
Route::match(['get','post'],'admin/view/requirement/{id}','Admin\adminuserController@view_requirement');
Route::match(['get','post'],'admin/edit/requirement/{id}','Admin\adminuserController@edit_requirement');
Route::match(['get','post'],'admin/delete/requirement/{id}','Admin\adminuserController@delete_requirement');
Route::match(['get','post'],'admin/add/requirement','Admin\adminuserController@addrequirement');
Route::match(['get','post'],'admin/all/requirement','Admin\adminuserController@allrequirement');
Route::match(['get','post'],'store/requirement/admin','Admin\adminuserController@store_requirement');
Route::match(['get','post'],'requirement/update/admin/{id}','Admin\adminuserController@update_requirement');


Route::match(['get','post'],'admin/add/property','Admin\adminsellerController@add_property'); 
Route::match(['get','post'],'file-upload','Admin\adminsellerController@dragdrop'); 
Route::match(['get','post'],'admin/all/properties','Admin\adminsellerController@all_property'); 
Route::match(['get','post'],'admin/property/{id}/update','Admin\adminsellerController@update');
Route::match(['get','post'],'deleteproperty/{id}','Admin\adminsellerController@property_delete');
Route::match(['get','post'],'admin_view/property/{id}','Admin\adminsellerController@view_property');

/*** Subsciprtion ***/
Route::match(['get','post'],'/admin/add-subscription','subscriptionController@addSubscription');
Route::match(['get','post'],'/admin/edit-subscription/{id}','subscriptionController@editSubscription');
Route::match(['get','post'],'/admin/delete-subscription/{id}','subscriptionController@deleteSubscription');
Route::get('/admin/view-subscription','subscriptionController@viewSubscription');

/*** Setting ***/
Route::match(['get','post'],'/admin/edit-profile','SettingController@editAdminprofile');
Route::match(['get','post'],'/admin/general','SettingController@generalSetting');

/*** Homepage Slider ***/
Route::match(['get','post'],'admin/add/slider','Admin\sliderController@add_slider'); 
Route::match(['get','post'],'admin/all/slider','Admin\sliderController@all_slider'); 
Route::match(['get','post'],'admin/slider/{id}/update','Admin\sliderController@update');
Route::match(['get','post'],'admin/slider/{id}/delete','Admin\sliderController@slider_delete');
Route::match(['get','post'],'admin/slider/{id}/view','Admin\sliderController@view_slider');

/*** Pages ***/
Route::match(['get','post'],'/admin/add-page','PagesController@addPages');
Route::match(['get','post'],'/admin/edit-page/{id}','PagesController@editPages');
Route::match(['get','post'],'/admin/delete-page/{id}','PagesController@deletePages');
Route::get('/admin/view-page','PagesController@viewPages');

/*** Testimonial ***/
Route::match(['get','post'],'admin/testimonial/add','Admin\testimonialController@add'); 
Route::match(['get','post'],'admin/testimonial/all','Admin\testimonialController@all'); 
Route::match(['get','post'],'admin/testimonial/{id}/update','Admin\testimonialController@update');
Route::match(['get','post'],'admin/testimonial/{id}/delete','Admin\testimonialController@delete');
Route::match(['get','post'],'admin/testimonial/{id}/view','Admin\testimonialController@view');