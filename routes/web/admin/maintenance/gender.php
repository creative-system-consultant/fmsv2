<?php

use App\Livewire\Admin\Maintenance\Gender\GenderList;

Route::get('/', GenderList::class)->name('list');