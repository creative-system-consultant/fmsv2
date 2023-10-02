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
use App\Livewire\Admin\Maintenance\Gender\GenderList;
use App\Livewire\Admin\Maintenance\Marital\MaritalCreate;
use App\Livewire\Admin\Maintenance\Marital\MaritalEdit;
use App\Livewire\Admin\Maintenance\Marital\MaritalList;
use App\Livewire\Admin\Maintenance\Title\TitleList;
use App\Livewire\Admin\Maintenance\Title\TitleCreate;
use App\Livewire\Admin\Maintenance\Title\TitleEdit;
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

        Route::prefix('cif')->group(function(){
            Route::get('/', Individual::class)->name('individual');
            Route::get('info', Info::class)->name('info');

            //detail
            Route::get('details',Details::class)->name('details');

            //address
            Route::get('address',Address::class)->name('address');

            //beneficiary
            Route::get('beneficiary',Beneficiary::class)->name('beneficiary');

            //Third Party Info
            Route::get('ThirdParty',ThirdPartyInfo::class)->name('ThirdPartyInfo');

            //Others Payment
            Route::get('OthersPayment',OthersPayment::class)->name('OthersPayment');

            //guarantee
            Route::get('guarantee',Guarantee::class)->name('guarantee');

            

            //Contribution
            Route::get('contribution', Contribution::class)->name('contribution');

            //Share
            Route::get('share', Share::class)->name('Share');

            //Finance
            Route::get('finance', Finance::class)->name('Finance');

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




