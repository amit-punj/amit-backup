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

Route::get('/', 'HomeController@homepage')->name('home');
Route::get('/home', 'HomeController@homepage')->name('home');

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

Route::match(['get','post'],'admin/import-property', 'Admin\adminsellerController@import_property');

/*** Subsciprtion ***/
Route::match(['get','post'],'/admin/add-subscription','subscriptionController@addSubscription');
Route::match(['get','post'],'/admin/edit-subscription/{id}','subscriptionController@editSubscription');
Route::match(['get','post'],'/admin/delete-subscription/{id}','subscriptionController@deleteSubscription');
Route::get('/admin/view-subscription','subscriptionController@viewSubscription');

Route::get('/admin/transaction-list','subscriptionController@transaction_list');

/*** Setting ***/
Route::match(['get','post'],'/admin/edit-profile','Admin\adminController@editAdminprofile');
Route::match(['get','post'],'/admin/general','Admin\adminController@generalSetting');

// Route::match(['get','post'],'/admin/edit-profile','SettingController@editAdminprofile');
// Route::match(['get','post'],'/admin/general','SettingController@generalSetting');

/*** Homepage Slider ***/
Route::match(['get','post'],'admin/add/slider','Admin\sliderController@add_slider'); 
Route::match(['get','post'],'admin/all/slider','Admin\sliderController@all_slider'); 
Route::match(['get','post'],'admin/slider/{id}/update','Admin\sliderController@update');
Route::match(['get','post'],'admin/slider/{id}/delete','Admin\sliderController@slider_delete');
Route::match(['get','post'],'admin/slider/{id}/view','Admin\sliderController@view_slider');

/*** Client ***/
Route::match(['get','post'],'admin/add/client','Admin\clientController@add_client_admin');
Route::match(['get','post'],'admin/adduser_client/{id}','Admin\clientController@adduser_client'); 
Route::match(['get','post'],'admin/all/client','Admin\clientController@all_client'); 
Route::match(['get','post'],'admin/client/{id}/update','Admin\clientController@update');
Route::match(['get','post'],'admin/client/{id}/delete','Admin\clientController@client_delete');
Route::match(['get','post'],'admin/client/{id}/view','Admin\clientController@view_client');
Route::match(['get','post'],'user/client/view/{id}','Admin\clientController@view_user_client');

Route::match(['get','post'],'admin/slider/search_bar','Admin\sliderController@search_bar');

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

      // Agent
Route::match(['get','post'],'agent/signup','agentController@signup')->middleware('top_bar');
Route::match(['get','post'],'agent/login','agentController@login')->name('agent/login')->middleware('top_bar');
Route::match(['get','post'],'agent/home','agentController@dashboard');
Route::match(['get','post'],'agent/logout','agentController@logout');
Route::match(['get','post'],'agent/add/property','agentController@add_property');
Route::match(['get','post'],'agent/add/requirement','agentController@add_requirement');
Route::match(['get','post'],'agent/store/requirement','agentController@store_requirement');
Route::match(['get','post'],'file-upload1','agentController@dragdrop');

// Export and Import
Route::get('export', 'agentController@export')->name('export');
Route::get('importExportView', 'agentController@importExportView');
Route::post('import', 'agentController@import')->name('import');
Route::match(['get','post'],'import-property', 'agentController@import_property');
Route::match(['get','post'],'import-requirement', 'agentController@import_requirement');

/*Search Property*/
Route::match(['get','post'],'agent/search_req','agentController@search_req');
Route::match(['get','post'],'agent/advance_search','agentController@advance_search');
Route::match(['get','post'],'agent/requirement-advance_search','agentController@requirement_advance_search');
Route::match(['get','post'],'agent/preview/property','agentController@preview_property');
Route::match(['get','post'],'agent/property/save','agentController@agent_property_save');
Route::get('ajaxdata/removedata','agentController@removedata')->name('ajaxdata.removedata');
Route::get('admin/removedata','Admin\adminsellerController@remove_images');
Route::get('agent/requirement/list','agentController@requirement_list_view');
Route::get('myproperty/list','agentController@myproperty_list');

Route::match(['get','post'],'signuppre','PayPalController@signuppre');
Route::match(['get','post'],'/membership', 'PayPalController@getIndex')->middleware('auth');
Route::match(['get','post'],'paypal/ec-checkout', 'PayPalController@getExpressCheckout');
Route::match(['get','post'],'paypal/ec-checkout-success', 'PayPalController@getExpressCheckoutSuccess');
Route::match(['get','post'],'paypal/adaptive-pay', 'PayPalController@getAdaptivePay');
Route::match(['get','post'],'paypal/notify', 'PayPalController@notify');
Route::match(['get','post'],'agent/requirement/save','agentController@store_preview_requirement');


/*Profile*/
Route::match(['get','post'],'agent-dashboard','agentController@agent_dashboard');
Route::match(['get','post'],'agent-transaction','HomeController@transaction_list');
Route::match(['get','post'],'agent-profile','agentController@agent_profile');
Route::match(['get','post'],'agent/change-password','agentController@change_password');
Route::match(['get','post'],'agent-profile-view','agentController@agent_profile_view');



Route::match(['get','post'],'property/detail/{id}','agentController@property_detail');
Route::match(['get','post'],'myview/require/{id}','agentController@remview');
Route::match(['get','post'],'edit/require/{id}','agentController@req_edit');
Route::match(['get','post'],'agent/update-requirement/{id}','agentController@update_requirement');
Route::match(['get','post'],'delete/requirement/{id}','agentController@delete_requirement');


Route::match(['get','post'],'edit/property/{id}','agentController@property_edit');
Route::match(['get','post'],'agent/update-property/{id}','agentController@update_property');
Route::match(['get','post'],'delete/property/{id}','agentController@delete_property');

/*Home pages*/
Route::match(['get','post'],'page/{slug}','HomeController@pages');

// view
Route::match(['get','post'],'property/detail/pub/{id}','HomeController@property_detail');
Route::match(['get','post'],'requirement/detail/pub/{id}','HomeController@requirement_detail');
Route::match(['get','post'],'property/user/view/{id}','HomeController@property_user');
Route::match(['get','post'],'requirement/user/view/{id}','HomeController@property_user');
Route::match(['get','post'],'requirement/table/{id}','HomeController@table_view_requirement');
Route::match(['get','post'],'profile/pagination','HomeController@profile_pagination');
// agent-profile this is url update profile
//clients agent
Route::match(['get','post'],'client/list/agent','agentController@client_list');
Route::match(['get','post'],'agent/add/client','agentController@add_client');
Route::match(['get','post'],'agent/client/{id}/edit_agent','agentController@edit_client');
Route::match(['get','post'],'agent/client/{id}/delete','agentController@delete_client');
Route::match(['get','post'],'agent/view/client/{id}','agentController@view_client');
Route::match(['get','post'],'user/getclient','Admin\adminuserController@getuser_client');
Route::match(['get','post'],'login','agentController@login')->middleware('top_bar');
Route::match(['get','post'],'register','agentController@signup')->middleware('top_bar');
Route::match(['get','post'],'get/enquire','userController@enquire');
Route::match(['get','post'],'agent_membership/renew','agentController@change_membership');
Route::match(['get','post'],'agent/search_list/data','agentController@search_list_data');
Route::match(['get','post'],'agent/buyer/search/data','agentController@search_list_buyers');
Route::match(['get','post'],'agent/edit/data/search/{id}','agentController@edit_search_data');
Route::match(['get','post'],'agent/update/search/{id}','agentController@update_search_data');
Route::match(['get','post'],'agent/delete/search/{id}','agentController@delete_search_data');
Route::match(['get','post'],'user-connect-agent','agentController@agent_connect');
Route::match(['get','post'],'save/my/search','agentController@save_my_search');
Route::match(['get','post'],'user_request/connect','agentController@user_request_list');
Route::match(['get','post'],'request/accept/user/{id}','agentController@accept_request');
Route::match(['get','post'],'request/cancel/user/{id}','agentController@cancel_request');
Route::match(['get','post'],'agent/list/users_accepted','agentController@agent_accepted_list');
Route::match(['get','post'],'confirm/request/in/page/{id}','agentController@confirm_in_page');
Route::match(['get','post'],'agent-message-friends','agentController@message_list');
Route::match(['get','post'],'chat-users/{id}','agentController@chat_box_pannel');
Route::match(['get','post'],'message_save_users','agentController@message_save');
Route::match(['get','post'],'delele/conversation/user','agentController@temp_delete_msg');
Route::match(['get','post'],'unfriend/agent/{id}','agentController@unfriend_agents');
// Route::get('/email_test', function () {
//     return view('email.new_message', ['from' => 'James','name'=>'yes','id'=>123]);
// });