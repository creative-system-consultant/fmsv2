<?php

use App\Livewire\Admin\Maintenance\Glcode\GlcodeCreate;
use App\Livewire\Admin\Maintenance\Glcode\GlcodeEdit;
use App\Livewire\Admin\Maintenance\Glcode\GlcodeList;

Route::get('/', GlcodeList::class)->name('list');
Route::get('create', GlcodeCreate::class)->name('create');
Route::get('edit/{id}', GlcodeEdit::class)->name('edit');