<?php

use App\Livewire\Admin\Maintenance\Bank\BankCreate;
use App\Livewire\Admin\Maintenance\Bank\BankEdit;
use App\Livewire\Admin\Maintenance\Bank\BankList;

Route::get('/',BankList::class)->name('list');
Route::get('create',BankCreate::class)->name('create');
Route::get('edit/{id}',BankEdit::class)->name('edit');