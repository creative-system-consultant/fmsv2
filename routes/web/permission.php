<?php

use App\Livewire\SysAdmin\Permission;

Route::get('/', Permission::class)->name('index');
