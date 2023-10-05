<?php

use App\Livewire\Report\ReportList;
use App\Livewire\Report\Listing\ListMember;
use App\Livewire\Report\MonthlyArea\MaAge;
use App\Livewire\Report\MonthlyArea\MaEmployer;

Route::get('index', ReportList::class)->name('report-list');
Route::get('list-member', ListMember::class)->name('report-list-member');
Route::get('ma-age', MaAge::class)->name('report-ma-age');
Route::get('ma-employer', MaEmployer::class)->name('report-ma-employer');