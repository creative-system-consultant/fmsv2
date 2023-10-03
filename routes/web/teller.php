<?php

use App\Livewire\Teller\TellerList;
use App\Livewire\Teller\Refundadvance\RefundAdvanceList;
use App\Livewire\Teller\Refundadvance\RefundAdvanceCreate;

Route::get('list', TellerList::class)->name('teller-list');
Route::get('refund-advance-list', RefundAdvanceList::class)->name('teller-refund-advance-list');
Route::get('refund-advance-create/{id}', RefundAdvanceCreate::class)->name('teller-refund-advance-create');
