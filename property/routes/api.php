<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/reminder-email', 'Api@reminder_email');
Route::get('/check-receipt-upload', 'Api@check_receipt_upload');
Route::get('/check-appointment-reply', 'Api@check_appintment_reply');


Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
Route::post('stripePayDues/{id}', 'StripePaymentController@stripe_Pay_Dues')->name('stripe.PayDues');
Route::post('stripeAddMoney', 'StripePaymentController@stripe_add_money')->name('stripe.AddMoney');