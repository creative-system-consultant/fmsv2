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
use App\Livewire\Report\Operation\List\BskeGoldbarTrx;
use App\Livewire\Report\Operation\List\DormantMember;
use App\Livewire\Report\Operation\List\ClosedMember;
use App\Livewire\Report\Operation\List\Deduction;
use App\Livewire\Report\Operation\List\DetailForCashDisbursement;
use App\Livewire\Report\Operation\List\DividendPayment;
use App\Livewire\Report\Operation\List\EntranceFee;
use App\Livewire\Report\Operation\List\Financing;
use App\Livewire\Report\Operation\List\FinTrxBaseOnDisbursement;
use App\Livewire\Report\Operation\List\FullSettlement;
use App\Livewire\Report\Operation\List\Introducer;
use App\Livewire\Report\Operation\List\Member;
use App\Livewire\Report\Operation\List\MemberNotPayContribution;
use App\Livewire\Report\Operation\List\NonCashProduct;
use App\Livewire\Report\Operation\List\Retirement;
use App\Livewire\Report\Operation\List\TakafulPayment;
//member
use App\Livewire\Report\Operation\Member\Byincome;
use App\Livewire\Report\Operation\Member\ByState;

//monthly
use App\Livewire\Report\Operation\Monthly\MthlyNpfAcc;
use App\Livewire\Report\Operation\Monthly\ArrearsAccount;
use App\Livewire\Report\Operation\Monthly\ContributionDetailsMonthly;
use App\Livewire\Report\Operation\Monthly\ContributionSummaryYearly;
use App\Livewire\Report\Operation\Monthly\DetailsYearlyShare;
use App\Livewire\Report\Operation\Monthly\ListShareDetail;
use App\Livewire\Report\Operation\Monthly\ShareSummaryYearly;
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
Route::get('list/entrance-fee', EntranceFee::class)->name('list.entrance-fee');
Route::get('list/full-settlement', FullSettlement::class)->name('list.full-settlement');
Route::get('list/deduction', Deduction::class)->name('list.deduction');
Route::get('list/retirement', Retirement::class)->name('list.retirement');
Route::get('list/detail-for-cash-disbursement', DetailForCashDisbursement::class)->name('list.detail-for-cash-disbursement');
Route::get('list/Bske-Goldbar-Trax', BskeGoldbarTrx::class)->name('list.Bske-Goldbar-Trax');
Route::get('list/financing', Financing::class)->name('list.financing');
Route::get('list/introducer', Introducer::class)->name('list.introducer');
Route::get('list/non-cash-product', NonCashProduct::class)->name('list.non-cash-product');
Route::get('list/takaful-payment', TakafulPayment::class)->name('list.takaful-payment');
Route::get('list/dividend-payment', DividendPayment::class)->name('list.dividend-payment');

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
Route::get('monthly/arrears-account', ArrearsAccount::class)->name('monthly.arrears-account');
Route::get('monthly/list-share-detail', ListShareDetail::class)->name('monthly.list-share-detail');
Route::get('monthly/share-summary-yearly', ShareSummaryYearly::class)->name('monthly.share-summary-yearly');
Route::get('monthly/contribution-details-monthly', ContributionDetailsMonthly::class)->name('monthly.contribution-details-monthly');
Route::get('monthly/contribution-summary-yearly', ContributionSummaryYearly::class)->name('monthly.contribution-summary-yearly');
Route::get('monthly/details-yearly-share', DetailsYearlyShare::class)->name('monthly.details-yearly-share');
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