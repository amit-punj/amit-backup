<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', 'AdminController@dashboard')->name('index');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/heatmap', 'AdminController@heatmap')->name('heatmap');
Route::get('/translation',  'AdminController@translation')->name('translation');
Route::get('/update-schedule-ride',  'AdminController@update_schedule_ride');

Route::group(['as' => 'dispatcher.', 'prefix' => 'dispatcher'], function () {
	Route::get('/', 'DispatcherController@index')->name('index');
	Route::post('/', 'DispatcherController@store')->name('store');
    Route::get('/trips', 'DispatcherController@trips')->name('trips');
    Route::get('/cancelled', 'DispatcherController@cancelled')->name('cancelled');
	Route::get('/cancel', 'DispatcherController@cancel')->name('cancel');
	Route::get('/trips/{trip}/{provider}', 'DispatcherController@assign')->name('assign');
	Route::get('/users', 'DispatcherController@users')->name('users');
	Route::get('/providers', 'DispatcherController@providers')->name('providers');
});

Route::resource('user', 'Resource\UserResource');
Route::resource('dispatch-manager', 'Resource\DispatcherResource');
Route::resource('account-manager', 'Resource\AccountResource');
Route::resource('fleet', 'Resource\FleetResource');
Route::resource('provider', 'Resource\ProviderResource');
Route::resource('document', 'Resource\DocumentResource');
Route::resource('service', 'Resource\ServiceResource');
Route::resource('promocode', 'Resource\PromocodeResource');
Route::resource('quest', 'Resource\QuestTargetResource');
Route::resource('referrals', 'Resource\ReferralsResource');
Route::resource('areaservice', 'Resource\AreaServiceResource');
Route::resource('category', 'Resource\CategoryResource');
Route::resource('faq', 'Resource\FaqResource');
Route::resource('ticket', 'Resource\TicketResource');

Route::group(['as' => 'areaservice.'], function () {
    Route::match(['get','post'],'areaservice/create/{id}/service/type', 'Resource\AreaServiceResource@create_service_type')->name('create.servicetype');
    Route::match(['get','post'],'areaservice/edit/{id}/{area_id}/service/type', 'Resource\AreaServiceResource@edit_service_type')->name('edit.servicetype');
    Route::match(['get','post','delete'],'areaservice/destroy/{id}/service/type', 'Resource\AreaServiceResource@destroy_service_type')->name('destroy.servicetype');
    Route::match(['get','post'],'areaservice/get/serviceTypeDetails', 'Resource\AreaServiceResource@get_serviceTypeDetails')->name('get.serviceTypeDetails');
});

Route::group(['as' => 'provider.'], function () {
    Route::get('review/provider', 'AdminController@provider_review')->name('review');
    Route::get('provider/{id}/approve', 'Resource\ProviderResource@approve')->name('approve');
    Route::get('provider/{id}/disapprove', 'Resource\ProviderResource@disapprove')->name('disapprove');
    Route::get('provider/{id}/request', 'Resource\ProviderResource@request')->name('request');
    Route::get('provider/{id}/statement', 'Resource\ProviderResource@statement')->name('statement');
    Route::resource('provider/{provider}/document', 'Resource\ProviderDocumentResource');
    Route::delete('provider/{provider}/service/{document}', 'Resource\ProviderDocumentResource@service_destroy')->name('document.service');
    

    Route::match(['get','post'],'provider/{provider}/document/{document}', 'Resource\ProviderDocumentResource@destroy')->name('document.destroy');

    Route::post('provider/account', 'Resource\ProviderResource@account')->name('account');
    // Route::get('provider/docs', 'Resource\ProviderResource@docs')->name('docs');

    /*Route for making default vehicle*/
    Route::match(['get','post'],'provider/vehicle/prime_status', 'Resource\ProviderDocumentResource@vehicle_prime_status')->name('vehicle.prime_status');

    /* Route for vehicle approve and reject Start*/
    Route::match(['get','post'],'provider/{provider}/document/{document}', 'Resource\ProviderDocumentResource@destroy')->name('document.destroy');

    Route::match(['get','post'],'provider/{provider}/vehicle/{vehicle}/document/{document}/{status}', 'Resource\ProviderDocumentResource@vehicle_document_update')->name('vehicle.document.update_status');
    /* Route for vehicle approve and reject End*/

});

/* Provider Tickets Route */
Route::match(['get','post'],'provider/{id}/provider_tickets', 'Resource\ProviderResource@providerTicketList')->name('provider.ticketList');
Route::match(['get','post'],'provider/provider_ticket/{tid}', 'Resource\ProviderResource@providerTicket')->name('provider.providerTicket');

/* User Review and Request Route */
Route::get('review/user', 'AdminController@user_review')->name('user.review');
Route::get('user/{id}/request', 'Resource\UserResource@request')->name('user.request');

/* User Actions Route */
Route::get('user/{id}/approve', 'Resource\UserResource@approve')->name('user.approve');
Route::get('user/{id}/disapprove', 'Resource\UserResource@disapprove')->name('user.disapprove');
Route::post('user/account_details', 'Resource\UserResource@accountDetails')->name('account_details');
Route::match(['get','post'],'user/{id}/user_tickets', 'Resource\UserResource@userTicketList')->name('user.ticketList');
Route::match(['get','post'],'user/user_ticket/{tid}', 'Resource\UserResource@userTicket')->name('user.userTicket');
// Route::match(['get','post'],'user/{id}/user_tickets', 'Resource\UserResource@user_tickets')->name('user.ticket');

Route::match(['get','post'],'faq/delete/{faq}', 'Resource\FaqResource@delete');

/* Ticket/Support Routes */
Route::get('ticket/{id}/approve', 'Resource\TicketResource@approve')->name('ticket.approve');
Route::get('ticket/{id}/disapprove', 'Resource\TicketResource@disapprove')->name('ticket.disapprove');
Route::post('ticket/{id}/store', 'Resource\TicketResource@store')->name('ticket.store');

Route::get('map', 'AdminController@map_index')->name('map.index');
Route::get('map/ajax', 'AdminController@map_ajax')->name('map.ajax');

Route::get('settings', 'AdminController@settings')->name('settings');
Route::post('settings/store', 'AdminController@settings_store')->name('settings.store');
Route::get('settings/payment', 'AdminController@settings_payment')->name('settings.payment');
Route::post('settings/payment', 'AdminController@settings_payment_store')->name('settings.payment.store');

Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');

Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');

Route::get('payment', 'AdminController@payment')->name('payment');

// statements

Route::get('/statement', 'AdminController@statement')->name('ride.statement');
Route::get('/statement/all', 'AdminController@statement_all')->name('ride.statement.all');
Route::get('/statement/provider', 'AdminController@statement_provider')->name('ride.statement.provider');
Route::get('/statement/today', 'AdminController@statement_today')->name('ride.statement.today');
Route::get('/statement/monthly', 'AdminController@statement_monthly')->name('ride.statement.monthly');
Route::get('/statement/yearly', 'AdminController@statement_yearly')->name('ride.statement.yearly');


// Static Pages - Post updates to pages.update when adding new static pages.

Route::get('/help', 'AdminController@help')->name('help');
Route::get('/send/push', 'AdminController@push')->name('push');
Route::post('/send/push', 'AdminController@send_push')->name('send.push');
Route::get('/privacy', 'AdminController@privacy')->name('privacy');
Route::get('/TermsANDConditions', 'AdminController@TermsANDConditions')->name('TermsANDConditions');
Route::post('/pages', 'AdminController@pages')->name('pages.update');
Route::resource('requests', 'Resource\TripResource');
Route::get('scheduled', 'Resource\TripResource@scheduled')->name('requests.scheduled');

Route::get('push', 'AdminController@push_index')->name('push.index');
Route::post('push', 'AdminController@push_store')->name('push.store');

Route::get('/add', 'AdminController@assignProviderForm');

Route::get('/dispatch', function () {
    return view('admin.dispatch.index');
});

Route::get('/cancelled', function () {
    return view('admin.dispatch.cancelled');
});

Route::get('/ongoing', function () {
    return view('admin.dispatch.ongoing');
});

Route::get('/schedule', function () {
    return view('admin.dispatch.schedule');
});

/*Route::get('/add', function () {
    return view('admin.dispatch.add');
});*/

Route::get('/assign-provider', function () {
    return view('admin.dispatch.assign-provider');
});

Route::get('/dispute', function () {
    return view('admin.dispute.index');
});

Route::get('/dispute-create', function () {
    return view('admin.dispute.create');
});

Route::get('/dispute-edit', function () {
    return view('admin.dispute.edit');
});