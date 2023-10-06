<?php

namespace App\Services\Model;

use App\Models\Fms\FmsAccountMaster as FmsAccountMasterModel;

class FmsAccountMaster
{
    public function __construct()
    {
        //
    }

    public static function getAccountData($account_no)
    {
        return FmsAccountMasterModel::with(['cifCustomer', 'fmsAccountPosition'])->whereAccountNo($account_no)->first();
    }

    public static function updateAccountData($account_no, $data)
    {
        return FmsAccountMasterModel::whereAccountNo($account_no)->update($data);
    }
}