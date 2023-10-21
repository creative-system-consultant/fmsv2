<?php

namespace App\Traits;

trait CloseMembershipRulesTrait
{
    public function getCloseMembershipRules()
    {
        return [
            // 'docNo' => 'required',
            'txnAmt' => 'required',
            'txnDate' => 'required|before_or_equal:today',
        ];
    }
}