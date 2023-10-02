<?php

use App\Livewire\Admin\Maintenance\State\StateList;
use App\Livewire\Admin\Maintenance\State\StateCreate;
use App\Livewire\Admin\Maintenance\State\StateEdit;

Route::get('/', StateList::class)->name('list');
Route::get('StateCreate', StateCreate::class)->name('create');
Route::get('StateEdit/{id}', StateEdit::class)->name('edit');