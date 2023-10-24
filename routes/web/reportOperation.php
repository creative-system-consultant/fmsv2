<?php

//Contribution
use App\Livewire\Report\Operation\Contribution\Payment;
use App\Livewire\Report\Operation\Contribution\Withdrawal;

//DailyTransaction 
use App\Livewire\Report\Operation\DailyTransaction\Listing;
use App\Livewire\Report\Operation\DailyTransaction\Product;

//financing
use App\Livewire\Report\Operation\Financing\CashDetail;
use App\Livewire\Report\Operation\Financing\Disbursement;
use App\Livewire\Report\Operation\Financing\Summary;
use App\Livewire\Report\Operation\Financing\Approval;

//list
use App\Livewire\Report\Operation\List\Autopay;
use App\Livewire\Report\Operation\List\Bank;
use App\Livewire\Report\Operation\List\DormantMember;
use App\Livewire\Report\Operation\List\ClosedMember;
use App\Livewire\Report\Operation\List\FinTrxBaseOnDisbursement;
use App\Livewire\Report\Operation\List\Member;
use App\Livewire\Report\Operation\List\MemberNotPayContribution;

//member
use App\Livewire\Report\Operation\Member\Byincome;
use App\Livewire\Report\Operation\Member\ByState;

//monthly
use App\Livewire\Report\Operation\Monthly\MthlyNpfAcc;
use App\Livewire\Report\Operation\Monthly\MthlyFinPosition;
use App\Livewire\Report\Operation\Monthly\ReportResc;
use App\Livewire\Report\Operation\Monthly\DetailsYrlyCont;
use App\Livewire\Report\Operation\Monthly\DetailsFinMthly;
use App\Livewire\Report\Operation\Monthly\DetailsFinYrly;

//share
use App\Livewire\Report\Operation\Share\SharePurchase;
use App\Livewire\Report\Operation\Share\ShareRedemption;
use App\Livewire\Report\Operation\Share\ShareWithdrawal;

//summary
use App\Livewire\Report\Operation\Summary\SumTotalShare;
use App\Livewire\Report\Operation\Summary\SumTotalCont;

//contribution
Route::get('contribution/payment', Payment::class)->name('contribution.payment');
Route::get('contribution/withdrawal', Withdrawal::class)->name('contribution.withdrawal');

//list
Route::get('list/autopay', Autopay::class)->name('list.autopay');
Route::get('list/member', Member::class)->name('list.member');
Route::get('list/closed-member', ClosedMember::class)->name('list.closed-member');
Route::get('list/bank', Bank::class)->name('list.bank');
Route::get('list/dormant-member', DormantMember::class)->name('list.dormant-member');
Route::get('list/fin-trx-base-disbursement', FinTrxBaseOnDisbursement::class)->name('list.fin-trx-base-disbursement');
Route::get('list/member-not-pay-contribution', MemberNotPayContribution::class)->name('list.member-not-pay-contribution');

//daily transaction
Route::get('dailytransaction/listing', Listing::class)->name('dailytransaction.listing');
Route::get('dailytransaction/product', Product::class)->name('dailytransaction.product');

//financing
Route::get('financing/summary', Summary::class)->name('financing.summary');
Route::get('financing/disbursement', Disbursement::class)->name('financing.disbursement');
Route::get('financing/cashdetail', CashDetail::class)->name('financing.cashdetail');
Route::get('financing/approval', Approval::class)->name('financing.approval');

//member
Route::get('member/byincome', ByIncome::class)->name('member.byincome');
Route::get('member/by-state', ByState::class)->name('member.by-state');

//monthly
Route::get('monthly/mthlynpfacc', MthlyNpfAcc::class)->name('monthly.mthlynpfacc');
Route::get('monthly/mthly-fin-position', MthlyFinPosition::class)->name('monthly.mthly-fin-position');
Route::get('monthly/report-resc', ReportResc::class)->name('monthly.report-resc');
Route::get('monthly/details-yrly-cont', DetailsYrlyCont::class)->name('monthly.details-yrly-cont');
Route::get('monthly/details-fin-mthly', DetailsFinMthly::class)->name('monthly.details-fin-mthly');
Route::get('monthly/details-fin-yrly', DetailsFinYrly::class)->name('monthly.details-fin-yrly');

//share
Route::get('share/share-purchase', SharePurchase::class)->name('share.share-purchase');
Route::get('share/share-redemption', ShareRedemption::class)->name('share.share-redemption');
Route::get('share/share-withdrawal', ShareWithdrawal::class)->name('share.share-withdrawal');

//summary
Route::get('summary/sum-total-share', SumTotalShare::class)->name('summary.sum-total-share');
Route::get('summary/sum-total-cont', SumTotalCont::class)->name('summary.sum-total-cont');