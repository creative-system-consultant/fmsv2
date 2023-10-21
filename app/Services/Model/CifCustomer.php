<?php

namespace App\Services\Model;

use App\Models\Cif\CifCustomer as ModelCifCustomer;

/**
 * Service class for managing CifCustomer-related operations.
 */
class CifCustomer
{
    /**
     * Fetches all CIF customers from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of ModelCifCustomer instances.
     */
    public static function getAllCifCustomer()
    {
        return ModelCifCustomer::all();
    }

    /**
     * Retrieves the CIF customer by their Identity Card number (IC).
     *
     * @param string $ic The IC number to search for.
     * @return \Illuminate\Database\Eloquent\Builder Returns the query builder instance for the found customer.
     */
    public static function getCifCustomerByIc($ic)
    {
        return ModelCifCustomer::whereIdentityNo($ic)->first();
    }

    /**
     * Retrieves the CIF customer by their Identity Card number (IC).
     *
     * @param string $uuid The UUID number to search for.
     * @return \Illuminate\Database\Eloquent\Builder Returns the query builder instance for the found customer.
     */
    public static function getCifCustomerByUuid($uuid)
    {
        return ModelCifCustomer::whereUuid($uuid)->first();
    }

    public static function getCustomerSearchData($uuid)
    {
        return ModelCifCustomer::join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', '=', 'CIF.Customers.id')
        ->leftJoin('FMS.MISC_ACCOUNT', 'FMS.MISC_ACCOUNT.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
        ->leftJoin('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
        ->leftJoin('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.ACCOUNT_MASTERS.account_no')
        ->where('CIF.Customers.uuid', $uuid)
        ->select(
            'CIF.Customers.uuid',
            'CIF.Customers.id',
            'CIF.Customers.name',
            'CIF.Customers.identity_no',
            'CIF.Customers.bank_id',
            'CIF.Customers.bank_acct_no',
            'FMS.MEMBERSHIP.mbr_no',
            'FMS.MEMBERSHIP.staff_no',
            'FMS.MEMBERSHIP.total_contribution',
            'FMS.MEMBERSHIP.total_share',
            'FMS.MISC_ACCOUNT.misc_amt',
            'FMS.ACCOUNT_MASTERS.id as account_master_id',
            'FMS.ACCOUNT_MASTERS.account_no',
            'FMS.ACCOUNT_MASTERS.rebate_amt',
            'FMS.ACCOUNT_MASTERS.settle_profit',
            'FMS.ACCOUNT_POSITIONS.bal_outstanding'
        )
        ->first();
    }

    /**
     * Fetches the search data for CIF customers based on the provided parameters.
     *
     * @param array $conditions Associative array with keys as column names and values as the condition to match.
     * @param string|null $search The search keyword.
     * @param string|null $searchBy The column to search by.
     * @param string|null $sortField The column to sort by.
     * @param string|null $sortDirection The direction to sort (asc or desc).
     * @param array $relationships Associative array with keys as column names and values as the condition to match.
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated result set.
     */
    public static function fetchByCondition(
        array $conditions = [],
        $searchBy = null,
        $search = null,
        $sortField = null,
        $sortDirection = null,
        array $relationships = []
    ) {
        $query = ModelCifCustomer::query();

        if (!empty($relationships)) {
            $query->with($relationships);
        }

        foreach ($conditions as $condition) {
            $method = array_shift($condition);

            if (strpos($method, '.') !== false) {
                [$relation, $relationMethod] = explode('.', $method);
                $query->whereHas($relation, function ($subQuery) use ($relationMethod, $condition) {
                    call_user_func_array([$subQuery, $relationMethod], $condition);
                });
            } else {
                call_user_func_array([$query, $method], $condition);
            }
        }

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        if ($sortField && $sortDirection) {
            $query->orderBy($sortField, $sortDirection);
        }

        return $query->paginate(10);
    }

    /**
     * Creates a new CIF customer entry in the database.
     *
     * @param array $data The data for the new customer.
     */
    public static function createCifCustomer($data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->id,
        ];

        $mergedData = array_merge($data, $defaultData);

        ModelCifCustomer::create($mergedData);
    }

    /**
     * Updates an existing CIF customer's data by their IC.
     *
     * @param string $ic The IC number of the customer to update.
     * @param array $data The data to update.
     */
    public static function updateCifCustomer($ic, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->id,
        ];

        $mergedData = array_merge($data, $defaultData);

        ModelCifCustomer::whereIdentityNo($ic)->update($mergedData);
    }

    /**
     * Deletes a CIF customer by their IC.
     *
     * @param string $ic The IC number of the customer to delete.
     */
    public function deleteCifCustomer($ic)
    {
        ModelCifCustomer::ModelCifCustomer($ic)->delete();
    }
}
