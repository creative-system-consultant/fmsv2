<?php

namespace App\Livewire\Teller;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TellerList extends Component
{
    public $type_payment_in = '';
    public $type_payment_out = '';

    public $options = [
        'in' => [
            'Payment Contribution' => 'teller.payment-contribution.payment-contribution',
            'Purchase Share' => 'teller.purchase-share.purchase-share',
            'Financing Repayment' => 'teller.financing-repayment.financing-repayment',
            'Early Setllement Payment' => 'teller.settlement-payment.settlement-payment',
            'Third Party' => 'teller.third-party.third-party',
            'Miscellaneous in' => 'teller.miscellaneous-in.miscellaneous-in',
            'Autopay' => 'teller.autopay.autopay',
            'Early Settlement Overlap' => 'teller.settlement-overlap.settlement-overlap',
            'Bulk Payment' => 'teller.bulk-payment.bulk-payment',
        ],
        'out' => [
            'Withdraw Contribution' => 'teller.withdraw-contribution.withdraw-contribution',
            'Withdraw Share' => 'teller.withdraw-share.withdraw-share',
            'Close Membership' => 'teller.close-membership.close-membership',
            'Payment to Members' => 'teller.payment-member.payment-member',
            'Dividend Withdrawal' => 'teller.withdraw-dividen.withdraw-dividen',
            'Disbursement' => 'teller.disbursement.disbursement-transaction',
            'Miscellaneous Out' => 'teller.miscellaneous-out.miscellaneous-out-list',
            'Refund Advance' => 'teller.refund-advance.refund-advance-list',
            'Dividen Batch Widthdrawal' => 'teller.dividen-batch.dividen-batch',
        ]
    ];

    public function updatedTypePaymentIn()
    {
        $this->render();
    }

    public function updatedTypePaymentOut()
    {
        $this->render();
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.teller-list');
    }
}
