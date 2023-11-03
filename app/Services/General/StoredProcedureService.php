<?php

namespace App\Services\General;

use DB;
use Illuminate\Database\QueryException;

class StoredProcedureService
{
    public function __construct()
    {

    }

    /**
     * Execute a stored procedure with the given name and parameters.
     *
     * @param string $procedureName
     * @param array $parameters
     * @param boolean $setCount
     * @return array
     */
    public function execute($procedureName, $parameters, $setCount = false)
    {
        // Start a database transaction.
        DB::beginTransaction();

        try {
            // Construct the SQL statement to execute the stored procedure with an optional "SET NOCOUNT ON".
            $sqlPrefix = $setCount ? "SET NOCOUNT ON; " : "";
            $sql = $sqlPrefix . "EXEC {$procedureName} " . $this->placeholders($parameters);

            // Execute the statement and capture the result.
            $result = DB::statement($sql, $parameters);

            // Commit the transaction.
            DB::commit();

            return ['success' => true, 'result' => $result];
        } catch (QueryException $e) {
            // Roll back the transaction.
            DB::rollBack();

            // Process and return the error information.
            return ['success' => false, 'error' => $this->processErrorInfo($e->errorInfo)];
        }
    }

    /**
     * Generate SQL placeholders for the parameters.
     *
     * @param array $parameters
     * @return string
     */
    private function placeholders($parameters)
    {
        return implode(', ', array_map(function ($param) {
            return ':' . $param;
        }, array_keys($parameters)));
    }

    /**
     * Process the error information to exclude every third element starting from the first.
     *
     * @param array $errorInfo
     * @return array
     */
    private function processErrorInfo($errorInfo)
    {
        // Filter and chunk the error information.
        $filteredErrorInfo = array_values(array_filter(
            $errorInfo,
            function ($key) {
                return $key % 3 !== 0;
            },
            ARRAY_FILTER_USE_KEY
        ));

        return array_chunk($filteredErrorInfo, 2);
    }
}