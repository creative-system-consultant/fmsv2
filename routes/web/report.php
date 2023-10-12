<?php

use App\Livewire\Report\ReportList;
use App\Livewire\Report\Listing\ListMember;
use App\Livewire\Report\MonthlyArea\MaAge;
use App\Livewire\Report\MonthlyArea\MaAgeing;
use App\Livewire\Report\MonthlyArea\MaEmployer;
use App\Livewire\Report\MonthlyArea\MaProduct;
use App\Livewire\Report\MonthlyArea\MaState;
use App\Livewire\Report\MonthlyContribution\McSummary;
use App\Livewire\Report\MonthlyFinancingPosition\MfpSummary;
use App\Livewire\Report\MonthlyNpf\MnpfSummary;
use App\Livewire\Report\MonthlyShare\MsSummary;

// Management
Route::get('index', ReportList::class)->name('report-list');
Route::get('list-member', ListMember::class)->name('report-list-member');
Route::get('ma-age', MaAge::class)->name('report-ma-age');
Route::get('ma-employer', MaEmployer::class)->name('report-ma-employer');
Route::get('ma-product', MaProduct::class)->name('report-ma-product');
Route::get('ma-state', MaState::class)->name('report-ma-state');
Route::get('ma-ageing', MaAgeing::class)->name('report-ma-ageing');
Route::get('mc-summary', McSummary::class)->name('report-mc-summary');
Route::get('mfp-summary', MfpSummary::class)->name('report-mfp-summary');
Route::get('mnpf-summary', MnpfSummary::class)->name('report-mnpf-summary');
Route::get('ms-summary', MsSummary::class)->name('report-ms-summary');

// Operation