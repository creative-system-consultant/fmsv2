<?php

namespace App\Traits;

trait WithdrawContributionRulesTrait
{
    public function getWithdrawContributionRules()
    {
        return [
            'txnAmt' => 'required',
            'txnDate' => 'required|before_or_equal:today',
        ];
    }
}
