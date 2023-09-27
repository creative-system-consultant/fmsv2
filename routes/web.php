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
use App\Livewire\Admin\Maintenance\Glcode\GlcodeCreate;
use App\Livewire\Admin\Maintenance\Glcode\GlcodeEdit;
use App\Livewire\Admin\Maintenance\Glcode\GlcodeList;
use App\Livewire\Admin\Maintenance\Race\RaceCreate;
use App\Livewire\Admin\Maintenance\Race\RaceEdit;
use App\Livewire\Admin\Maintenance\Race\RaceList;
use App\Livewire\Cif\Individual;
use App\Livewire\Cif\Info;
use App\Livewire\Cif\Info\Details;
use App\Livewire\Cif\Info\Address;
use App\Livewire\Cif\Info\Beneficiary;

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
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');

        Route::prefix('cif')->group(function(){
            Route::get('/', Individual::class)->name('individual');
            Route::get('info', Info::class)->name('info');
            Route::get('details', Details::class)->name('details');
            Route::get('address', Address::class)->name('address');
            Route::get('beneficiary', Beneficiary::class)->name('beneficiary');
        });

        Route::prefix('admin')->group(function(){
        Route::prefix('maintenance')->group(function(){
            //Admin->Maintenance->Race
            Route::prefix('race')->group(function(){
                Route::get('/', RaceList::class)->name('race.list');
                Route::get('create', RaceCreate::class)->name('race.create');
                Route::get('edit/{id}', RaceEdit::class)->name('race.edit');

            });
            //Admin->Maintenance->Gl code
            Route::prefix('glcode')->group(function(){
                Route::get('/', GlcodeList::class)->name('glcode.list');
                Route::get('create', GlcodeCreate::class)->name('glcode.create');
                Route::get('edit/{id}', GlcodeEdit::class)->name('glcode.edit');

            });

        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('home', Home::class)->name('home');
});


//Doc
Route::get('doc', Doc::class)->name('doc');


