<?php

use App\Http\Controllers\Backend\DashboardController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::group([ 'middleware' => 'checkTempPass' ], function (){
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');  
    
});

Route::get('file-export/employee/attendance/{id}', 'DashboardController@fileExport')->name('file-export.employee.attendance');
