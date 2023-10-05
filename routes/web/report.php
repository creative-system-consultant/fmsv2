<?php

use App\Livewire\Report\ReportList;
use App\Livewire\Report\Listing\ListMember;
use App\Livewire\Report\MonthlyArea\MaAge;
use App\Livewire\Report\MonthlyArea\MaAgeing;
use App\Livewire\Report\MonthlyArea\MaEmployer;
use App\Livewire\Report\MonthlyArea\MaProduct;
use App\Livewire\Report\MonthlyArea\MaState;

Route::get('index', ReportList::class)->name('report-list');
Route::get('list-member', ListMember::class)->name('report-list-member');
Route::get('ma-age', MaAge::class)->name('report-ma-age');
Route::get('ma-employer', MaEmployer::class)->name('report-ma-employer');
Route::get('ma-product', MaProduct::class)->name('report-ma-product');
Route::get('ma-state', MaState::class)->name('report-ma-state');
Route::get('ma-ageing', MaAgeing::class)->name('report-ma-ageing');