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
    
    });
    
});


// Local API Endpoint
Route::get('api/get-transactions', 'Api\TransactionController@getTransactions')->name('api.transactions');
