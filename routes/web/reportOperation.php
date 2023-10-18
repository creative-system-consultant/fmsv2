<?php

//list
use App\Livewire\Report\Operation\List\Autopay;
use App\Livewire\Report\Operation\List\DormantMember;
use App\Livewire\Report\Operation\List\FinTrxBaseOnDisbursement;
use App\Livewire\Report\Operation\DailyTransaction\Listing;
use App\Livewire\Report\Operation\DailyTransaction\Product;
use App\Livewire\Report\Operation\List\Member;
use App\Livewire\Report\Operation\Financing\CashDetail;
use App\Livewire\Report\Operation\Financing\Disbursement;
use App\Livewire\Report\Operation\Financing\Summary;
use App\Livewire\Report\Operation\Member\Byincome;

//summary
use App\Livewire\Report\Operation\Summary\sumtotalshare;
use App\Livewire\Report\Operation\Summary\sumtotalcont;

//share
use App\Livewire\Report\Operation\Share\sharewithdrawal;
use App\Livewire\Report\Operation\Share\shareredemption;
use App\Livewire\Report\Operation\Share\sharepurchase;

//list
Route::get('list/autopay', Autopay::class)->name('list.autopay');
Route::get('list/dormant-member', DormantMember::class)->name('list.dormant-member');
Route::get('list/fin-trx-base-disbursement', FinTrxBaseOnDisbursement::class)->name('list.fin-trx-base-disbursement');

//member
Route::get('member/byincome', Byincome::class)->name('member.byincome');
Route::get('list/member', Member::class)->name('list.member');

//daily transaction
Route::get('dailytransaction/listing', Listing::class)->name('dailytransaction.listing');
Route::get('dailytransaction/product', Product::class)->name('dailytransaction.product');

//financing
Route::get('financing/summary', Summary::class)->name('financing.summary');
Route::get('financing/disbursement', Disbursement::class)->name('financing.disbursement');
Route::get('financing/cashdetail', CashDetail::class)->name('financing.cashdetail');

//summary
Route::get('sumtotalshare', sumtotalshare::class)->name('summary.sumtotalshare');
Route::get('sumtotalcont', sumtotalcont::class)->name('summary.sumtotalcont');

//share
Route::get('sharewithdrawal', sharewithdrawal::class)->name('share.sharewithdrawal');
Route::get('shareredemption', shareredemption::class)->name('share.shareredemption');
Route::get('share/sharepurchase', sharepurchase::class)->name('share.sharepurchase');
