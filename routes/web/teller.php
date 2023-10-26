<?php

use App\Livewire\Teller\TellerList;
use App\Livewire\Teller\MiscellaneousOut\MiscellaneousOutList;
use App\Livewire\Teller\MiscellaneousOut\MiscellaneousOutCreate;
use App\Livewire\Teller\Disbursement\DisbursementTransaction;
use App\Livewire\Teller\WithdrawContribution\WithdrawContribution;
use App\Livewire\Teller\CloseMembership\CloseMembership;
use App\Livewire\Teller\TransferShare\TransferShare;
use App\Livewire\Teller\PaymentMember\PaymentMember;
use App\Livewire\Teller\ThirdParty\ThirdParty;
use App\Livewire\Teller\VirtualAccount\VirtualAccount;
use App\Livewire\Teller\WithdrawDividen\WithdrawDividen;
use App\Livewire\Teller\AccountOverlap\AccountOverlap;
use App\Livewire\Teller\Autopay\Autopay;
use App\Livewire\Teller\GlTransaction\GlTransaction;
use App\Livewire\Teller\SettlementOverlap\SettlementOverlap;
use App\Livewire\Teller\DividenApproval\DividenApproval;
use App\Livewire\Teller\DividenBatch\DividenBatch;

Route::get('list', TellerList::class)->name('teller-list');
Route::get('miscellaneous-out-list', MiscellaneousOutList::class)->name('teller-miscellaneous-out-list');
Route::get('miscellaneous-out-create/{id}', MiscellaneousOutCreate::class)->name('teller-miscellaneous-out-create');
Route::get('disbursement', DisbursementTransaction::class)->name('teller-disbursement');
Route::get('withdraw-contribution', WithdrawContribution::class)->name('teller-withdraw-contribution');
Route::get('close-membership', CloseMembership::class)->name('teller-close-membership');
Route::get('transfer-share', TransferShare::class)->name('teller-transfer-share');
Route::get('payment-member', PaymentMember::class)->name('teller-payment-member');
Route::get('third-party', ThirdParty::class)->name('teller-third-party');
Route::get('virtual-account-inventory', VirtualAccount::class)->name('teller-virtual-account-inventory');
Route::get('withdraw-dividen', WithdrawDividen::class)->name('teller-withdraw-dividen');
Route::get('account-overlap', AccountOverlap::class)->name('teller-account-overlap');
Route::get('autopay', Autopay::class)->name('teller-autopay');
Route::get('gl-transaction', GlTransaction::class)->name('teller-gl-transaction');
Route::get('settlement-overlap', SettlementOverlap::class)->name('teller-settlement-overlap');
Route::get('dividen-approval', DividenApproval::class)->name('teller-dividen-approval');
Route::get('dividen-batch-withdraw', DividenBatch::class)->name('teller-dividen-batch-withdraw');
