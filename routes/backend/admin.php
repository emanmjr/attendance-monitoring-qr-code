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
        Route::get('/kyc-lookup', 'TransactionController@kycLookUp')->name('kyc-lookup');
    
    });

    // MyWU
    Route::group(['prefix' => 'mywu', 'as' =>'mywu.'], function(){

        Route::get('/enrollment', 'MyWUController@enrollment')->name('enrollment');
        Route::get('/customer', 'MyWUController@customer')->name('customer');
    
    });
    
});


// Transactions API 
Route::get('api/get-transactions', 'Api\TransactionController@getTransactions')->name('api.transactions');

// KYC LOOKUP Api
Route::post('api/kyc-lookup', 'Api\TransactionController@kycLookUp')->name('api.kyc-lookup');

// MYWU Enrollment Api
Route::post('api/enroll-customer', 'Api\MyWUController@enrollCustomer')->name('api.enroll.customer');


