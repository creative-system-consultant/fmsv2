<?php

//Monthly Arrears

use App\Livewire\Report\Management\MonthlyArrears\MthAgeing;
use App\Livewire\Report\Management\MonthlyArrears\MthByAge;
use App\Livewire\Report\Management\MonthlyArrears\MthByEmployer;
use App\Livewire\Report\Management\MonthlyArrears\MthByProduct;
use App\Livewire\Report\Management\MonthlyArrears\MthByState;
use App\Livewire\Report\Management\MonthlyContribution\ContributionSummary;
use App\Livewire\Report\Management\MonthlyFinancingPosition\FinancingPosition;
use App\Livewire\Report\Management\MonthlyNpf\MthlyNpfSum;
use App\Livewire\Report\Management\MonthlyShare\MthShareSummary;

// Management
Route::get('monthly-arrears/mth-by-employer', MthByEmployer::class)->name('monthly-arrears.mth-by-employer');
Route::get('monthly-arrears/mth-by-product', MthByProduct::class)->name('monthly-arrears.mth-by-product');
Route::get('monthly-arrears/mth-ageing', MthAgeing::class)->name('monthly-arrears.mth-ageing');
Route::get('monthly-arrears/mth-by-state', MthByState::class)->name('monthly-arrears.mth-by-state');
Route::get('monthly-arrears/mth-by-age', MthByAge::class)->name('monthly-arrears.mth-by-age');
Route::get('monthly-contribution/contribution-summary', ContributionSummary::class)->name('monthly-contribution.contribution-summary');
Route::get('monthly-financing-position/financing-position', FinancingPosition::class)->name('monthly-financing-position.financing-position');
Route::get('monthly-npf/mthly-npf-sum', MthlyNpfSum::class)->name('monthly-npf.mthly-npf-sum');
Route::get('monthly-share/mth-share-summary', MthShareSummary::class)->name('monthly-share.mth-share-summary');