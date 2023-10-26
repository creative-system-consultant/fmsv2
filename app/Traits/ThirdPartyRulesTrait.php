<?php

namespace App\Traits;

trait ThirdPartyRulesTrait
{
    public function getThirdParty()
    {
        if ($this->selectedType == 'cheque') {
            return [
                'txnAmt' => 'required|numeric|gte:minThirdparty',
                'txnDate' => 'required|before_or_equal:today',
                'remarks' => 'required',
                'chequeNo' => 'required',
                'chequeDate' => 'required',
                'bankMember' => 'required',
            ];
        } elseif ($this->selectedType == 'cash/cdm') {
            return [
                'txnAmt' => 'required|numeric|gte:minThirdparty',
                'txnDate' => 'required|before_or_equal:today',
                'remarks' => 'required',
            ];
        } elseif ($this->selectedType == 'ibt') {
            return [
                'txnAmt' => 'required|numeric|gte:minThirdparty',
                'txnDate' => 'required|before_or_equal:today',
                'remarks' => 'required',
            ];
        } elseif ($this->selectedType == 'contribution') {
            return [
                'txnAmt' => 'required|numeric|gte:minThirdparty',
                'txnDate' => 'required|before_or_equal:today',
            ];
        } else {
            return [
                'txnAmt' => 'required|numeric|gte:minThirdparty',
                'txnDate' => 'required|before_or_equal:today',
                'remarks' => 'required',
            ];
        }
    }
}