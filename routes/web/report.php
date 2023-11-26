<?php

use App\Livewire\Report\ReportList;

Route::get('index', ReportList::class)->name('report-list');

// Report Management
Route::prefix('management')->as('management.')->group(
    base_path('routes/web/reportManagement.php')
);

// Report Operation
Route::prefix('operation')->as('operation.')->group(
    base_path('routes/web/reportOperation.php')
);