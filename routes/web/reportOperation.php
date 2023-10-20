<?php

//list
use App\Livewire\Report\Operation\List\Autopay;
use App\Livewire\Report\Operation\List\DormantMember;
use App\Livewire\Report\Operation\List\FinTrxBaseOnDisbursement;

//member
use App\Livewire\Report\Operation\Member\Byincome;
use App\Livewire\Report\Operation\List\Member;

//daily transaction
use App\Livewire\Report\Operation\DailyTransaction\Listing;
use App\Livewire\Report\Operation\DailyTransaction\Product;

//financing
use App\Livewire\Report\Operation\Financing\Summary;
use App\Livewire\Report\Operation\Financing\Disbursement;
use App\Livewire\Report\Operation\Financing\CashDetail;

//monthly
use App\Livewire\Report\Operation\Monthly\MthlyNpfAcc;

//summary
use App\Livewire\Report\Operation\Summary\SumTotalShare;
use App\Livewire\Report\Operation\Summary\SumTotalCont;

//share
use App\Livewire\Report\Operation\Share\SharePurchase;
use App\Livewire\Report\Operation\Share\ShareRedemption;
use App\Livewire\Report\Operation\Share\ShareWithdrawal;


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

//monthly
Route::get('monthly/mthlynpfacc', MthlyNpfAcc::class)->name('monthly.mthlynpfacc');

//summary
Route::get('summary/sum-total-share', SumTotalShare::class)->name('summary.sum-total-share');
Route::get('summary/sum-total-cont', SumTotalCont::class)->name('summary.sum-total-cont');

//share
Route::get('share/share-purchase', SharePurchase::class)->name('share.share-purchase');
Route::get('share/share-redemption', ShareRedemption::class)->name('share.share-redemption');
Route::get('share/share-withdrawal', ShareWithdrawal::class)->name('share.share-withdrawal');
