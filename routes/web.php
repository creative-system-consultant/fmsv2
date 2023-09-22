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
use App\Livewire\admin\maintenance\Education\EducationCreate;
use App\Livewire\admin\maintenance\Education\EducationEdit;
use App\Livewire\admin\maintenance\Education\EducationList;
use App\Livewire\Admin\Maintenance\Bank\BankCreate;
use App\Livewire\admin\maintenance\Bank\BankEdit;
use App\Livewire\admin\maintenance\Bank\BankList;
use App\Livewire\Admin\Maintenance\Country\CountryCreate;
use App\Livewire\Admin\Maintenance\Country\CountryEdit;
use App\Livewire\Admin\Maintenance\Country\CountryList;

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
            
            //Admin -> Maintenance -> Education
            Route::prefix('education')->group(function(){
                Route::get('/',EducationList::class)->name('education.list');
                Route::get('create',EducationCreate::class)->name('education.create');
                Route::get('edit/{id}',EducationEdit::class)->name('education.edit');
            });
           
            //Admin -> Maintenance -> Bank
            Route::prefix('bank')->group(function(){
                Route::get('/',BankList::class)->name('bank.list');
                Route::get('create',BankCreate::class)->name('bank.create');
                Route::get('edit/{id}',BankEdit::class)->name('bank.edit');
            });

            //Admin -> Maintenance -> Country
            Route::prefix('country')->group(function(){ 
                Route::get('/',CountryList::class)->name('country.list');
                Route::get('create',CountryCreate::class)->name('country.create');
                Route::get('edit/{id}',CountryEdit::class)->name('country.edit');
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




