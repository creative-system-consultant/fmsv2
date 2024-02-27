<?php

namespace App\Traits;

trait SpecialAidRulesTrait
{
    public function getSpecialAidRules()
    {
        return [
            'approved_amount'   => 'required',
            'txn_date'          => 'required|before_or_equal:today',
        ];
    }
}
