<?php

namespace App\Services\Model;

use App\Models\Fms\FmsMiscAccount as ModelFmsMiscAccount;

/**
 * Service class for managing FmsMiscAccount-related operations.
 */
class FmsMiscAccount
{
    /**
     * Fetches all FmsMiscAccount from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of ModelFmsMiscAccount instances.
     */
    public static function getAllFmsMiscAccount()
    {
        return ModelFmsMiscAccount::all();
    }

    /**
     * Fetches first FmsMiscAccount by mbrno from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of ModelFmsMiscAccount instances.
     */
    public static function getFmsMiscAccountByMbrNo($mbrNo)
    {
        return ModelFmsMiscAccount::whereMbrno($mbrNo)->first();
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
        $query = ModelFmsMiscAccount::query();

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
     * Creates a new FmsMiscAccount entry in the database.
     *
     * @param array $data The data for the entry.
     */
    public static function createFmsMiscAccount($data)
    {
        //return
    }

    /**
     * Updates an existing FmsMiscAccount's data by key.
     *
     * @param string $key The key of the table to update.
     * @param array $data The data to update.
     */
    public static function updateFmsMiscAccount($key, $data)
    {
        //return
    }

    /**
     * Deletes a FmsMiscAccount by their key.
     *
     * @param string $key The key of the table to delete.
     */
    public function deleteFmsMiscAccount($key)
    {
        //return
    }
}