<?php

namespace App\Traits;

trait RefundAdvanceRulesTrait
{
    public function getRefundAdvanceRules()
    {
        return [
            'bankClient' => 'required',
            'bankMember' => 'required',
            'txnAmt' => 'required|numeric|lte:advancePayment',
            'txnDate' => 'required|before_or_equal:today',
        ];
    }
}