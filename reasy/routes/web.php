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

/*laravel chat // Route::get('/chat', 'ChatsController@index');
// Route::get('messages', 'ChatsController@fetchMessages');
// Route::post('messages', 'ChatsController@sendMessage');

/* Google */
Route::get('google', function () {
    return view('googleAuth');
});
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');


Route::get('/dynamic_pdf', 'PropertyController@pdf');

/* Home Page */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home-load-more', 'HomeController@homePageAjax')->name('home');

/*Homepage Search*/
Route::match(['get','post'],'property-search', 'HomeController@search');
Route::match(['get','post'],'change-to-tenant', 'HomeController@change_to_tenant');
Route::match(['get','post'],'change-role/{role}', 'HomeController@change_role');

/* FrontEnd User Auth */
Auth::routes(['verify' => true]);
Route::get('/change-password', 'Auth\ChangePasswordController@changePassword');
Route::post('/update-password', 'Auth\ChangePasswordController@updatePassword')->name('update-password');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::match(['get','post'],'Update-Password', 'Auth\RegisterController@update_password');


/* FrontEnd User Profile */
Route::get('/profile', 'ProfileController@index')->middleware('verified');
Route::get('/editprofile', 'ProfileController@editprofile')->middleware('verified');
Route::post('/updateprofile', 'ProfileController@updateprofile')->middleware('verified');
Route::get('/tenant-details/{id}', 'ProfileController@tenantDetails')->middleware('verified');
Route::get('/edit-bank-account/', 'ProfileController@editBankAccount')->middleware('verified');
Route::post('/update-bank-account/', 'ProfileController@updateBankAccount')->middleware('verified');
Route::get('/list-all-tenants/', 'ProfileController@listAllTenants')->middleware('verified');
Route::get('/list-tenants/{id}', 'ProfileController@listTenantsForSingleUnit')->middleware('verified','UnitAuthentication');

Route::match(['get','post'],'co-tenant-response/{id}/{response}','GuestController@co_tenant_response');
Route::match(['get','post'],'co-tenant-register','GuestController@co_tenant_register');
// Route::get('/purchasemSearch is working now.embership', 'ProfileController@purchaseview');


/* Meter */
Route::get('/list-meters/{id}', 'MeterController@listMeters')->middleware('verified','MeterAuthentication');
Route::get('/meter-details/{id}', 'MeterController@meterDetails')->middleware('verified','MeterAuthentication');
Route::post('/add-meter-reading/{id}', 'MeterController@addMeterReading')->middleware('verified','MeterAuthentication');
Route::get('/delete-meter-reading/{id}', 'MeterController@deleteMeterReading')->middleware('verified');
Route::post('/meter-reading-document', 'MeterController@uploadMeterReadingDocument')->middleware('verified');
Route::post('/create-meter', 'MeterController@createMeter')->middleware('verified','MeterAuthentication');
Route::get('/delete-meter/{id}', 'MeterController@deleteMeter')->middleware('verified','MeterAuthentication');
Route::post('/update-meter', 'MeterController@updateMeter')->middleware('verified','MeterAuthentication');
Route::get('/get-meter_list/{id}', 'MeterController@get_meter_list')->middleware('verified');


/* All User Dashboard View*/
Route::get('/dashboard', 'DashboardController@view')->middleware('verified');
Route::get('/delete-booking/{id}', 'DashboardController@delete_booking')->middleware('verified');


/* Property */
Route::get('/list-units', 'PropertyController@listUnit')->middleware('verified');
Route::get('/create-property', 'PropertyController@index')->middleware('verified', 'PoUser');
Route::post('/create-property', 'PropertyController@createProperty')->middleware('verified');
Route::get('/edit-unit/{id}', 'PropertyController@editUnit')->middleware('verified', 'UnitAuthentication');
Route::get('/edit-building/{id}', 'PropertyController@editBuilding')->middleware('verified', 'PoUser');
Route::get('/building-details/{id}', 'PropertyController@buildingDetails')->middleware('verified', 'PoUser');
Route::post('/property-images', 'PropertyController@dragdrop');
Route::get('/delete-property/{id}', 'PropertyController@deleteProperty')->middleware('verified', 'PoUser');
Route::get('/delete-unit/{id}', 'PropertyController@deleteUnit')->middleware('verified', 'UnitAuthentication');
Route::post('/update-unit/{id}', 'PropertyController@updateUnit')->middleware('verified', 'UnitAuthentication');
Route::post('/update-building/{id}', 'PropertyController@updateBuilding')->middleware('verified', 'PoUser');


/* PO Membership */
Route::get('/list-membership-plans','MembershipController@listMembershipPlans')->name('membership.listpaln');
Route::get('/plan-detail/{id}','MembershipController@planDetail');
Route::post('/membership-checkout','MembershipController@membershipCheckout');
Route::post('/membership-paypal','MembershipController@membershipPaypal');
Route::get('/membership-paypal-return', array('as' => 'membership.redirect.paypal','uses' => 'MembershipController@membershipPaypalReturn',));
Route::post('/membership-stripe','MembershipController@membershipStripe');
Route::post('/upgrade-membership-stripe','MembershipController@upgradeMembershipStripe');
Route::get('/register-membership/{id}','MembershipController@registerMembership')->name('membership.register');
Route::post('/verify-membership-email','MembershipController@verifyMembershipEmail');
Route::get('/membership-details', 'MembershipController@membershipDetails')->middleware('verified');
Route::post('/upgrade-membership', 'PaymentController@postUpgradeMembership');
Route::get('/upgrade-membership', array('as' => 'upgrade.status','uses' => 'PaymentController@getUpgradetStatus',));
Route::get('/upgrade-membership-checkout/{id}', 'MembershipController@upgradeMembershipCheckout');
//Route::get('/membership-paypal-return','MembershipController@membershipPaypalReturn')->name('membership.redirect.paypal');


/* Access Permission */
Route::get('/access-permission', 'AccessPermissionController@accessPermission')->middleware('verified', 'PoUser');
Route::post('/access-permission', 'AccessPermissionController@saveAccessPermission')->middleware('verified', 'PoUser');


/* Leagl Actions */
Route::get('/legal-actions', 'LegalActionController@legalAction')->middleware('verified', 'LegalAuthentication');
Route::get('/legal-action/{id}', 'LegalActionController@legalActionView')->middleware('verified', 'LegalAuthentication');
Route::post('/create-legal-action', 'LegalActionController@createLegalAction')->middleware('verified');
Route::post('/submit-legal-action-report', 'LegalActionController@submitLegalAactionReport')->middleware('verified');
Route::post('/unit-tenant-legal-advisor', 'LegalActionController@unitTenantLegalAdvisor')->middleware('verified');


//Paying Rent payunit-rent
Route::get('/bill-confirmed/{id}', 'PayingBillController@billConfirmed')->middleware('verified', 'PaymentAuthentication');
Route::get('/rent-confirmed/{id}', 'PayingBillController@rentConfirmed')->middleware('verified', 'PaymentAuthentication');
Route::get('/payunit-rent/{id}', 'PayingBillController@payUnitRent')->middleware('verified', 'PaymentAuthentication');
Route::get('/paymeter-bill/{id}', 'PayingBillController@payMeterBill')->middleware('verified', 'PaymentAuthentication');
Route::post('/stripe-payunitrent', 'PayingBillController@stripePayUnitRent');
Route::post('/stripe-paymeterbill', 'PayingBillController@stripePayMeterBill');
Route::post('/bank-paybill', 'PayingBillController@bankPayBill');
Route::post('/bank-payRent', 'PayingBillController@bankPayRent');
Route::post('/paypal-return-rent', 'PayingBillController@paypalRentReturn');
Route::get('/paypal-return-meterbill', array('as' => 'paypal.return.meterbill','uses' => 'PayingBillController@paypalMeterbillReturn',));
Route::get('/paypal-return-unitrent', array('as' => 'paypal.return.unitrent','uses' => 'PayingBillController@paypalUnitrentReturn',));


/* Tasks */
Route::get('/list-all-tasks', 'LegalActionController@listOfTasks')->middleware('verified');


/*TASK CALENDER*/
Route::resource('tasks', 'TasksController');
Route::match(['get','post'],'calender-events', 'EventController@index');
Route::get('my-calender', 'EventController@index')->middleware('verified');
Route::match(['get','post'],'add-availability', 'EventController@create')->middleware('verified');


/* Tickets */
Route::match(['get','post'],'ticket/list','ContractController@ticket_list');
Route::match(['get','post'],'/raise-ticket/{id}', 'ContractController@raise_ticket')->middleware('verified','TicketAuthentication');
Route::match(['get','post'],'/update-ticket-status', 'ContractController@update_ticket_status');
Route::get('/ticket-view/{id}', 'VisitController@ticket_view')->middleware('verified', 'TicketAuthentication');


/* Tenant */
Route::post('/create-visit', 'GuestController@createVisit');
Route::match(['get','post'],'/send-message/{id}', 'GuestController@send_message');
Route::match(['get','post'],'check-user', 'GuestController@check_user');
Route::match(['get','post'],'verify-email', 'GuestController@verify_email');


/* Guest book visit */
Route::post('/send-otp', 'GuestController@sendOtp');
Route::post('/verify-otp', 'GuestController@verifyOtp');
Route::post('/verify-visiter-email', 'GuestController@verifyEmail');
Route::post('/verify-email-token', 'GuestController@verifyToken');


/* For Send invitation */
Route::post('/send-invitation', 'InvitationController@sendMail');
Route::get('/create-invitation-user', 'InvitationController@createInvitationUser');
Route::post('/register-invitation-user', 'InvitationController@registerInvitationUser');


/* Guest */
Route::match(['get','post'],'/buy-property/{id}', 'GuestController@buy_property')->middleware('verified');
Route::get('/propertydetails/{id}', 'GuestController@viewProperty');
Route::match(['get','post'],'/book-property/{id}', 'GuestController@bookProperty');
Route::match(['get','post'],'/upload-receipt', 'GuestController@upload_receipt');
Route::match(['get','post'],'/upload-signature', 'GuestController@upload_signature');
Route::match(['get','post'],'/thankyou-for-book-property', 'GuestController@thankYouBooingProperty');
Route::match(['get','post'],'/guarantor-view/{id}', 'GuestController@guarantor_view');
Route::match(['get','post'],'/guarantor-update/{id}', 'GuestController@guarantor_update');

Route::match(['get','post'],'/guarantor-details/{id}', 'GuestController@contract_guarantor_view');



/* PM Contract */
Route::get('/create-contract', 'ContractController@createContractView')->middleware('verified');
Route::post('/create-contract', 'ContractController@createContract');
Route::post('/verify-user-email', 'ContractController@verifyEmail');
Route::post('/create-contract-user', 'ContractController@contractUser');
Route::post('/create-contract-tenant', 'ContractController@AddTenant_to_contract');
Route::post('/create-contract-company', 'ContractController@contractCompany');
Route::post('/get-contract-expert', 'ContractController@contractExtertData');
Route::get('/contracts', 'ContractController@ContractList');
Route::get('/contract-details/{id}', 'ContractController@contractDetails')->middleware('verified', 'ContractAuthentication');
Route::get('downloadExcel/{id}/{type}', 'ContractController@downloadExcel');
Route::match(['get','post'],'/contract-search', 'ContractController@contract_search');
Route::get('/dues-damages/{id}', 'ContractController@dues_damages')->middleware('verified');
Route::match(['get','post'],'/give-rating', 'ContractController@give_rating')->middleware('verified');
Route::match(['get','post'],'/pay-dues/{id}', 'ContractController@pay_dues')->middleware('verified');
Route::match(['get','post'],'/bank-payment/{id}', 'ContractController@bank_payment')->middleware('verified');
Route::match(['get','post'],'/terminate-contract/{id}', 'ContractController@terminate_contract')->middleware('verified');
Route::match(['get','post'],'/update-terminate-status/{id}', 'ContractController@update_terminate_status')->middleware('verified');
Route::match(['get','post'],'/pay-now', 'ContractController@pay_now')->middleware('verified');
Route::match(['get','post'],'/TerminateBT-Contract/{id}', 'ContractController@TerminateBT_contract')->middleware('verified');
Route::match(['get','post'],'/contract-cancelBY-tenant/{id}', 'ContractController@Contract_cancelBy_tenant')->middleware('verified');
Route::get('createcontract', array('as' => 'payment.contract.status','uses' => 'ContractController@getPaymentStatus',));


/* Payment */
Route::match(['get','post'],'paypal-refund-payment', 'PaymentController@refund_payment');
Route::post('property-payment', 'PaymentController@PropertyPayment');
Route::get('property-payment', array('as' => 'property-payment.status','uses' => 'PaymentController@PropertyPaymentStatus',));
Route::post('property-pay-dues/{id}', 'PaymentController@PropertyPayDues');
Route::get('property-pay-dues/{id}', array('as' => 'property-pay-dues.status','uses' => 'PaymentController@PropertyPayDuesStatus',));
Route::post('paypal-add-money', 'PaymentController@PaypalAddMoney');
Route::get('paypal-add-money', array('as' => 'paypal-add-money.status','uses' => 'PaymentController@PaypalAddMoneyStatus',));
Route::post('paypal', 'PaymentController@postPaymentWithpaypal');
Route::get('paypal', array('as' => 'payment.status','uses' => 'PaymentController@getPaymentStatus',));


/* Visit */
Route::get('/list-visits', 'VisitController@listVisits')->middleware('verified');
Route::get('/my-wallet', 'VisitController@my_wallet')->middleware('verified')->name('my.wallet');
Route::match(['get','post'],'/add-money', 'VisitController@add_money')->middleware('verified');
Route::get('/my-appointments', 'VisitController@my_appointments')->middleware('verified');
Route::get('/appointment-view/{id}', 'VisitController@appointment_view')->middleware('verified');
Route::match(['get','post'],'/update-status', 'VisitController@update_status')->middleware('verified');
Route::match(['get','post'],'/book-appointment', 'VisitController@book_appointment')->middleware('verified');
Route::match(['get','post'],'/book-appointment/{id}', 'VisitController@book_appointment_by_mail')->middleware('verified', 'ContractAuthentication');
Route::match(['get','post'],'/tenant-extend-contract/{id}', 'VisitController@tenant_extend_contract')->middleware('verified');
Route::match(['get','post'],'/upload-document', 'VisitController@upload_document')->middleware('verified');
Route::match(['get','post'],'/upload-exit-document', 'VisitController@upload_exit_document')->middleware('verified');
Route::match(['get','post'],'/getUnitByContract', 'VisitController@getUnitByContract')->middleware('verified');
Route::match(['get','post'],'/reschedule-appointment', 'VisitController@reschedule_appointment')->middleware('verified');
Route::match(['get','post'],'/update-appointment', 'VisitController@update_appointment')->middleware('verified');
Route::get('/completed-visits', 'VisitController@listVisits')->middleware('verified');
Route::get('/visit-details/{id}', 'VisitController@visitDetails')->middleware('verified', 'VisitAuthentication');
Route::get('/messenger','VisitController@messenger');
Route::match(['get','post'],'/email-reply/{id}','VisitController@email_reply');
Route::match(['get','post'],'/ticket-reply/{id}','VisitController@ticket_reply');
Route::match(['get','post'],'/get-chat-by-unit','VisitController@get_chat_by_unit');
Route::get('/messages','VisitController@messages')->middleware('verified');;
Route::post('/send-message','VisitController@send_message')->middleware('verified');
Route::post('/cancel-appointment','VisitController@cancel_appointment')->middleware('verified');
Route::match(['get','post'],'visit/add-remarks/{id}', 'VisitController@visit_addRemarks')->middleware('verified');


/* Property */
Route::get('/managnent', 'PropertyController@managnentUnits'); 
Route::get('/list-contracts/{id}', 'PropertyController@listContracts')->middleware('verified', 'UnitAuthentication');
Route::match(['get','post'],'/my-contract-list', 'PropertyController@my_contract_list')->middleware('verified');
Route::match(['get','post'],'/update-booking-status', 'PropertyController@update_booking_status')->middleware('verified');
Route::get('/unit-managment/{id}', 'PropertyController@unitManagment')->middleware('verified', 'UnitAuthentication');
Route::get('/email-verify', 'Auth\RegisterController@show1')->name('/email-verify');

//Route::get('/list-all-contracts/', 'PropertyController@listAllContracts');
//Route::get('/list-guarantors/{id}', 'PropertyController@listGuarantors')->middleware('verified');
//Route::get('/view-units/{id}', 'PropertyController@View_Unit')->middleware('verified');
//Route::get('/list-booking-requests', 'PropertyController@listBookingRequests')->middleware('verified');
//Route::get('/manage-list-units', 'PropertyController@managelistUnit')->middleware('verified');
//Route::post('/create-unit', 'PropertyController@createUnit');
//Route::get('/delete-contract/{id}', 'PropertyController@deleteContract');
//Route::post('/update-contract', 'PropertyController@updateContract');
//Route::get('/list-of-properties', 'PropertyController@list')->middleware('verified');
//Route::match(['get','post'],'unit/detail/{id}','GuestController@unit_detail_view');
//Route::get('/list-tenants/{id}', 'PropertyController@listTenants');
//Route::get('/admin/addproperty', 'Admin\PropertyController@index')->middleware('CheckUser');
// Route::match(['get','post'],'/terminate-contract/{id}', 'PropertyController@terminate_contract')->middleware('verified');


/* Admin Login */
Route::get('/admin-login', 'Admin\DashboardController@adminLogin');
Route::post('/admin-login', 'Admin\DashboardController@postAdminLogin'); 
Route::get('/admin/dashboard', 'Admin\DashboardController@index')->middleware('AdminUser'); 


/* Admin Cms pages */
Route::get('/admin/addcmspage', 'Admin\AddcmsController@index')->middleware('AdminUser');
Route::post('/admin/addcmspage', 'Admin\AddcmsController@create')->middleware('AdminUser');
Route::get('/admin/listcmspage', 'Admin\AddcmsController@list')->middleware('AdminUser');
Route::get('/admin/editcmspage/{id}', 'Admin\AddcmsController@edit')->middleware('AdminUser');
Route::post('/admin/updatecmspage', 'Admin\AddcmsController@update')->middleware('AdminUser');
Route::get('/admin/deletecmspage/{id}', 'Admin\AddcmsController@delete')->middleware('AdminUser');


/* Admin Users */
Route::get('/admin/listusers', 'Admin\UserlistController@list')->middleware('AdminUser');
Route::get('/admin/newuser', 'Admin\UserlistController@createView')->middleware('AdminUser');
Route::get('/admin/edituser/{id}', 'Admin\UserlistController@editUser')->middleware('AdminUser');
Route::post('/admin/updateuser', 'Admin\UserlistController@updateUser')->middleware('AdminUser');
Route::post('/admin/createnewuser', 'Admin\UserlistController@createUser')->middleware('AdminUser');
Route::get('/admin/deleteuser/{id}', 'Admin\UserlistController@delete')->middleware('AdminUser');


/* Admin Plans */
Route::get('/admin/addnewplan', 'Admin\PlanController@index')->middleware('AdminUser');
Route::post('/admin/addnewplan', 'Admin\PlanController@create')->middleware('AdminUser');
Route::get('/admin/listplans', 'Admin\PlanController@list')->middleware('AdminUser');
Route::get('/admin/editplanpage/{id}', 'Admin\PlanController@edit')->middleware('AdminUser');
Route::post('/admin/updateplanpage', 'Admin\PlanController@update')->middleware('AdminUser');
Route::get('/admin/deleteplanpage/{id}', 'Admin\PlanController@delete')->middleware('AdminUser');


/* Admin Property And contract */
Route::match(['get','post'],'list/all/properties','Admin\Admin_Property_Controller@list_all_property');
Route::match(['get','post'],'edit-unit-admin/{id}','Admin\Admin_Property_Controller@admin_editUnit');
Route::match(['get','post'],'view_unit-admin/{id}','Admin\Admin_Property_Controller@viewProperty_admin');
Route::match(['get','post'],'building-details_admin/{id}','Admin\Admin_Property_Controller@buildingDetails_admin');
Route::match(['get','post'],'create-property-admin','Admin\Admin_Property_Controller@createproperty');
Route::match(['get','post'],'edit-building-admin/{id}','Admin\Admin_Property_Controller@editBuilding');
Route::match(['get','post'],'list-tenants-admin/{id}','Admin\Admin_Property_Controller@property_tanents');
Route::match(['get','post'],'list-meters-admin/{id}','Admin\Admin_Meter_Controller@listMeters');
Route::match(['get','post'],'meter-details-admin/{id}','Admin\Admin_Meter_Controller@meterDetails');
Route::match(['get','post'],'list-contracts-admin/{id}','Admin\Admin_Property_Controller@listContracts');
Route::match(['get','post'],'filter/user','Admin\UserlistController@user_search_filter');
Route::match(['get','post'],'/admin/user/membership/list','Admin\UserlistController@user_membership_list');
Route::match(['get','post'],'delete/membership/user/{id}','Admin\UserlistController@delete_membership_list');
Route::match(['get','post'],'tanent-detail-admin/{id}','Admin\Admin_Property_Controller@tanent_detail_admin');
Route::match(['get','post'],'unit-managment-admin/{id}','Admin\Admin_Property_Controller@unitManagment_admin');
Route::match(['get','post'],'contract-list-admin','Admin\Admin_Property_Controller@admin_contract_list');
Route::match(['get','post'],'contract-detail-admin/{id}','Admin\Admin_Contract_Controller@admin_contractDetails');
Route::match(['get','post'],'update-unit-admin/{id}','Admin\Admin_Property_Controller@update_unit_admin');
Route::match(['get','post'],'add-property-admin','Admin\Admin_Property_Controller@admin_add_property');
Route::match(['get','post'],'update-building-admin/{id}','Admin\Admin_Property_Controller@update_building_admin');


/* Admin Redirecton */
Route::get('/admin', 'Admin\DashboardController@adminRedirect')->middleware('AdminUser');
Route::match(['get','post'],'admin-raise-ticket/{id}', 'Admin\Admin_Contract_Controller@add_ticket');
Route::match(['get','post'],'admin/ticket/listing', 'Admin\Admin_Contract_Controller@ticket_listing');
Route::match(['get','post'],'admin/extend-request/listing','Admin\DashboardController@extend_request');
Route::match(['get','post'],'admin/ticket-view/{id}','Admin\Admin_Contract_Controller@admin_ticket_view');
Route::match(['get','post'],'admin/edit-profile','Admin\DashboardController@edit_profile');

/*** Setting ***/
// Route::match(['get','post'],'/admin/edit-profile','Admin\adminController@editAdminprofile');
Route::match(['get','post'],'/admin/general','Admin\adminController@generalSetting');


Route::match(['get','post'],'/generate-rent','HomeController@generate_rent');
Route::match(['get','post'],'/generate-task','HomeController@generated_task');

