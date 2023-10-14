<?php

namespace App\Services\Model;

use App\Models\Fms\FmsGlobalParm as ModelFmsGlobalParm;

/**
 * Service class for managing FmsGlobalParm-related operations.
 */
class FmsGlobalParm
{
    /**
     * Fetches all FmsGlobalParm from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of ModelFmsGlobalParm instances.
     */
    public static function getAllFmsGlobalParm()
    {
        return ModelFmsGlobalParm::first();
    }

    /**
     * Fetches the search data for FmsGlobalParm based on the provided parameters.
     *
     * @param array $conditions Associative array with keys as column names and values as the condition to match.
     * @param string|null $search The search keyword.
     * @param string|null $searchBy The column to search by.
     * @param string|null $sortField The column to sort by.
     * @param string|null $sortDirection The direction to sort (asc or desc).
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated result set.
     */
    public static function fetchByCondition(array $conditions = [], $searchBy = null, $search = null, $sortField = null, $sortDirection = null)
    {
        $query = ModelFmsGlobalParm::query();

        foreach ($conditions as $condition) {
            $method = array_shift($condition);
            call_user_func_array([$query, $method], $condition);
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
     * Creates a new FmsGlobalParm entry in the database.
     *
     * @param array $data The data for the entry.
     */
    public static function createFmsGlobalParm($data)
    {
        //return
    }

    /**
     * Updates an existing FmsGlobalParm's data by key.
     *
     * @param string $key The key of the table to update.
     * @param array $data The data to update.
     */
    public static function updateFmsGlobalParm($key, $data)
    {
        //return
    }

    /**
     * Deletes a FmsGlobalParm by their key.
     *
     * @param string $key The key of the table to delete.
     */
    public function deleteFmsGlobalParm($key)
    {
        //return
    }
}