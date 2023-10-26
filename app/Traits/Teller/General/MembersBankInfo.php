<?php

namespace App\Traits\Teller\General;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsMiscAccount;

trait MembersBankInfo
{
    public $bankMember;
    public $memberBankAccNo;
    public $membersBankDetails = false;

    public function checkBankInfo(CifCustomer $cifCustomer)
    {
        $this->bankMember = $cifCustomer->bank_id;
        $this->memberBankAccNo = $cifCustomer->bank_acct_no;
        $this->membersBankDetails = $this->bankMember && $this->memberBankAccNo;
    }
}