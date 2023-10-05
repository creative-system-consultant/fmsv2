<?php

use App\Livewire\Report\ReportList;
use App\Livewire\Report\Listing\ListMember;

Route::get('index', ReportList::class)->name('report-list');
Route::get('list-member', ListMember::class)->name('report-list-member');