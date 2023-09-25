<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

use App\Livewire\Home\Home;
use App\Livewire\Doc\Doc;
use App\Livewire\Admin\Maintenance\Gender\GenderList;
use App\Livewire\Admin\Maintenance\Marital\MaritalCreate;
use App\Livewire\Admin\Maintenance\Marital\MaritalEdit;
use App\Livewire\Admin\Maintenance\Marital\MaritalList;
use App\Livewire\Admin\Maintenance\Title\TitleList;
use App\Livewire\Admin\Maintenance\Title\TitleCreate;
use App\Livewire\Admin\Maintenance\Title\TitleEdit;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class);
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::prefix('admin')->group(function(){
        Route::prefix('maintenance')->group(function(){

            //admin->maintenance->gender
            Route::prefix('gender')->group(function(){
                Route::get('/', GenderList::class)->name('gender.list');
            });

            //admin->maintenance->title
            Route::prefix('title')->group(function(){
                Route::get('/', TitleList::class)->name('title.list');
                Route::get('create', TitleCreate::class)->name('title.create');
                Route::get('edit/{id}', TitleEdit::class)->name('title.edit');
            });

            //admin->maintenance->marital
            Route::prefix('marital')->group(function(){
                Route::get('/', MaritalList::class)->name('marital.list');
                Route::get('create', MaritalCreate::class)->name('marital.create');
                Route::get('edit/{id}', MaritalEdit::class)->name('marital.edit');
            });
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('home', Home::class)->name('home');
});



//Doc
Route::get('doc', Doc::class)->name('doc');
