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
