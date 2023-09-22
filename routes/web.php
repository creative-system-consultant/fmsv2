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
use App\Livewire\Admin\Maintenance\Religion\ReligionList;
use App\Livewire\Admin\Maintenance\Religion\ReligionCreate;
use App\Livewire\Admin\Maintenance\Religion\ReligionEdit;
use App\Livewire\Admin\Maintenance\State\StateList;
use App\Livewire\Admin\Maintenance\State\StateCreate;
use App\Livewire\Admin\Maintenance\State\StateEdit;
use App\Livewire\Admin\Maintenance\Relationship\RelationshipList;
use App\Livewire\Admin\Maintenance\Relationship\RelationshipCreate;
use App\Livewire\Admin\Maintenance\Relationship\RelationshipEdit;

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

            //Admin->
            Route::prefix('religion')->group(function(){
            Route::get('/', ReligionList::class)->name('religion.list');
            Route::get('ReligionCreate', ReligionCreate::class)->name('religion.create');
            Route::get('ReligionEdit/{id}', ReligionEdit::class)->name('religion.edit');

        });  
   
            Route::prefix('state')->group(function(){
            Route::get('/', StateList::class)->name('state.list');
            Route::get('StateCreate', StateCreate::class)->name('state.create');
            Route::get('StateEdit/{id}', StateEdit::class)->name('state.edit');
        });     
        

            Route::prefix('relationship')->group(function(){
            Route::get('/', RelationshipList::class)->name('relationship.list');
            Route::get('RelationshipCreate', RelationshipCreate::class)->name('relationship.create');
            Route::get('RelationshipEdit/{id}', RelationshipEdit::class)->name('relationship.edit');
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

