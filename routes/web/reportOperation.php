<?php

use App\Livewire\Report\Operation\Contribution\Payment;
use App\Livewire\Report\Operation\Contribution\Withdrawal;
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

//contribution
Route::get('contribution/payment', Payment::class)->name('contribution.payment');
Route::get('contribution/withdrawal', Withdrawal::class)->name('contribution.withdrawal');

//daily transaction
Route::get('dailytransaction/listing', Listing::class)->name('dailytransaction.listing');
Route::get('dailytransaction/product', Product::class)->name('dailytransaction.product');

//financing
Route::get('financing/summary', Summary::class)->name('financing.summary');
Route::get('financing/disbursement', Disbursement::class)->name('financing.disbursement');
Route::get('financing/cashdetail', CashDetail::class)->name('financing.cashdetail');
// Route::get('financing/approval', Approval::class)->name('financing.approval');

// list
Route::get('list/autopay', Autopay::class)->name('list.autopay');
Route::get('list/dormant-member', DormantMember::class)->name('list.dormant-member');
Route::get('list/fin-trx-base-disbursement', FinTrxBaseOnDisbursement::class)->name('list.fin-trx-base-disbursement');

//member
Route::get('member/byincome', Byincome::class)->name('member.byincome');
Route::get('list/member', Member::class)->name('list.member');