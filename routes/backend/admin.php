<?php

use App\Http\Controllers\Backend\DashboardController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::group([ 'middleware' => 'checkTempPass' ], function (){
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transactions
    Route::group(['prefix' => 'transaction', 'as' =>'transaction.'], function(){
    
        Route::get('/send', 'TransactionController@send')->name('send');
        Route::get('/receive', 'TransactionController@receive')->name('receive');
        // Route::get('/kyc-lookup', 'TransactionController@kycLookUp')->name('kyc-lookup');
        
        Route::group(['middleware' => ['role:agent|sub_agent']], function(){
            Route::get('/pay-status', 'TransactionController@payStatus')->name('pay-status');
        });
    
    });

    // MyWU
    Route::group(['prefix' => 'mywu', 'as' =>'mywu.', 'middleware' => ['role:agent|sub_agent']], function(){

        Route::get('/enrollment', 'MyWUController@enrollment')->name('enrollment');
        Route::get('/customer', 'MyWUController@customer')->name('customer');
        // Route::get('/das-request', 'MyWUController@dasRequest')->name('das-request');
        // Route::get('/mywu-lookup', 'MyWUController@mywuLookup')->name('mywu-lookup');
    
    });
    
});


// Transactions API 
Route::get('api/get-transactions', 'Api\TransactionController@getTransactions')->name('api.transactions');

// KYC LOOKUP Api
Route::post('api/kyc-lookup', 'Api\TransactionController@kycLookUp')->name('api.kyc-lookup');

// MYWU Enrollment Api
Route::post('api/enroll-customer', 'Api\MyWUController@enrollCustomer')->name('api.enroll.customer');

// DAS Request Api
Route::post('api/das-request', 'Api\MyWUController@dasRequest')->name('api.das.request');

// MYWU LOOKUP Api
Route::post('api/mywu-lookup', 'Api\MyWUController@mywuLookup')->name('api.mywu-lookup');

// Pay Status Api
Route::post('api/pay-status', 'Api\TransactionController@payStatus')->name('api.pay-status');


