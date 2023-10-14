<?php

namespace App\Services\Model;

use App\Models\Fms\FmsAccountMaster as FmsAccountMasterModel;

/**
 * Service class for managing FmsAccountMaster operations.
 */
class FmsAccountMaster
{
    /**
     * Retrieves the account data for a given account number along with its related cifCustomer and fmsAccountPosition data.
     *
     * @param string $account_no The account number to search for.
     * @return FmsAccountMasterModel|null Returns the FmsAccountMasterModel instance if found, otherwise null.
     */
    public static function getAccountData($account_no)
    {
        return FmsAccountMasterModel::with(['fmsMembership', 'fmsMembership.cifCustomer', 'fmsAccountPosition'])->whereAccountNo($account_no)->first();
    }

    /**
     * Updates the account data for a given account number.
     *
     * @param string $account_no The account number to update.
     * @param array $data The data to be updated.
     * @return int Returns the number of records updated.
     */
    public static function updateAccountData($account_no, $data)
    {
        return FmsAccountMasterModel::whereAccountNo($account_no)->update($data);
    }
}
