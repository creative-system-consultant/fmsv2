<?php

use App\Livewire\SysAdmin\EditRole;
use App\Livewire\SysAdmin\Role;

Route::get('/', Role::class)->name('index');
Route::get('/edit-role/{id}', EditRole::class)->name('edit');