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

        Route::get('home', Home::class)->name('home');

        Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
            ->middleware('signed')
            ->name('verification.verify');

        Route::post('logout', LogoutController::class)
            ->name('logout');

        Route::get('email/verify', Verify::class)
            ->middleware('throttle:6,1')
            ->name('verification.notice');

        Route::get('password/confirm', Confirm::class)
            ->name('password.confirm');

        // cif
        Route::prefix('cif')->as('cif.')->group(
            base_path('routes/web/cif.php'),
        );

        //teller
        Route::prefix('teller')->as('teller.')->group(
            base_path('routes/web/teller.php'),
        );

        //finance
        Route::prefix('finance')->as('finance.')->group(
            base_path('routes/web/finance.php'),
        );

        //reversal
        Route::prefix('reversal')->as('reversal.')->group(
            base_path('routes/web/reversal.php'),
        );

         // admin/maintenance
        Route::prefix('Admin/Maintenance')->group(function(){

            //admin/maintenance/bank
            Route::prefix('Bank')->as('bank.')->group(
                base_path('routes/web/admin/maintenance/bank.php'),
            );

            //admin/maintenance/country
            Route::prefix('Country')->as('country.')->group(
                base_path('routes/web/admin/maintenance/country.php'),
            );

            //admin/maintenance/education
            Route::prefix('Education')->as('education.')->group(
                base_path('routes/web/admin/maintenance/education.php'),
            );

            //admin/maintenance/gender
            Route::prefix('Gender')->as('gender.')->group(
                base_path('routes/web/admin/maintenance/gender.php'),
            );

            //admin/maintenance/glcode
            Route::prefix('GLCode')->as('glcode.')->group(
                base_path('routes/web/admin/maintenance/glcode.php'),
            );

            //admin/maintenance/marital
            Route::prefix('Marital')->as('marital.')->group(
                base_path('routes/web/admin/maintenance/marital.php'),
            );

            //admin/maintenance/race
            Route::prefix('Race')->as('race.')->group(
                base_path('routes/web/admin/maintenance/race.php'),
            );

            //admin/maintenance/relationship
            Route::prefix('Relationship')->as('relationship.')->group(
                base_path('routes/web/admin/maintenance/relationship.php'),
            );

            //admin/maintenance/religion
            Route::prefix('Religion')->as('religion.')->group(
                base_path('routes/web/admin/maintenance/religion.php'),
            );

            //admin/maintenance/state
            Route::prefix('State')->as('state.')->group(
                base_path('routes/web/admin/maintenance/state.php'),
            );

            //admin/maintenance/title
            Route::prefix('Title')->as('title.')->group(
                base_path('routes/web/admin/maintenance/title.php'),
            );

        });

    });

//Doc
Route::get('doc', Doc::class)->name('doc');
