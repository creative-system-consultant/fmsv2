<?php

namespace App\Traits;

trait WithdrawShareRulesTrait
{
    public function getWithdrawShareRules()
    {
        return [
            'docNo' => 'required',
            'txnAmt' => 'required|lte:totalShareValid',
            'txnDate' => 'required|before_or_equal:today',
        ];
    }
}