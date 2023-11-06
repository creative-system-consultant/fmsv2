<?php

use App\Livewire\Cif\Other\Index as OtherIndex;
use App\Livewire\Cif\Other\OtherInfoList;

Route::get('other-info/{uuid}', OtherIndex::class)->name('other-info');

Route::get('info-list', OtherInfoList::class)->name('info-list');
