<?php

namespace App\Traits\Teller\PaymentContribution;

trait DetailsTrait
{
    public $type;
    public $customer;
    public $name;
    public $refNo;
    public $totalContribution = 0;
    public $minContribution = 0;
    public $refBank;
    public $refBankIbt;
    public $startDate;
    public $endDate;
    public $txnCode = '4020';
    public $clientId = 1;
    public $chequeDate;
    public $bankCustomer;
    public $bankClient;
    public $documentNo;
    public $transactionAmount = 50;
    public $transactionDate;
    public $remarks;
    public $saveButton = false;

    // Move the validation rules method as well
    protected function getValidationRules()
    {
        $baseRules = [
            'transactionAmount' => ['required', 'numeric', 'gte:minContribution'],
            'transactionDate' => ['required', 'before_or_equal:today'],
            'remarks' => ['required'],
        ];

        switch ($this->type) {
            case 'cheque':
                return array_merge($baseRules, [
                    'chequeDate' => ['required', 'before_or_equal:today'],
                    'bankCustomer' => ['required']
                ]);
            case 'cash':
                return $baseRules;
            case 'ibt/si':
                return array_merge($baseRules, [
                    'bankClient' => ['required']
                ]);
            default:
                return []; // or throw an exception if this is unexpected
        }
    }
}