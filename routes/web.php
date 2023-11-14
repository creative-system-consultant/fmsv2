<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Profile\Index as Profile;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

use App\Livewire\Home\Home;
use App\Livewire\Doc\Doc;
use App\Livewire\Report\ReportList;
use App\Livewire\SysAdmin\UserManagement;

// webhook from CSC-CA to clear cache on roles/user management update
Route::post('/webhook/clear-cache', function () {
    Artisan::call('cache:clear');
    return response('Cache Cleared', 200);
});

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
        Route::get('profile', Profile::class)->name('profile');

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

        //user management
        Route::get('user-management', UserManagement::class)->name('userManagement');

        // roles
        Route::prefix('roles')->as('roles.')->group(
            base_path('routes/web/role.php'),
        );

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

        //other
        Route::prefix('other')->as('other.')->group(
            base_path('routes/web/other.php'),
        );

        //reversal
        Route::prefix('reversal')->as('reversal.')->group(
            base_path('routes/web/reversal.php'),
        );

        //calculator
        Route::prefix('calculator')->as('calculator.')->group(
            base_path('routes/web/calculator.php'),
        );

        //dividen
        Route::prefix('dividen')->as('dividen.')->group(
            base_path('routes/web/dividen.php'),
        );

        // report List
        Route::prefix('report')->as('report.')->get('index', ReportList::class)->name('report-list');

        //report Management
        Route::prefix('report')->as('report.management.')->group(
            base_path('routes/web/reportManagement.php'),
        );

        //report Operation
        Route::prefix('report')->as('report.operation.')->group(
            base_path('routes/web/reportOperation.php'),
        );

        //admin/setting
        Route::prefix('Admin/setting')->as('setting.')->group(
            base_path('routes/web/admin/setting/setting.php'),
        );

        //admin/maintenance
        Route::prefix('Admin/Maintenance')->as('maintenance.')->group(
            base_path('routes/web/admin/maintenance/maintenance.php'),
        );

    });

//Doc
Route::get('doc', Doc::class)->name('doc');
