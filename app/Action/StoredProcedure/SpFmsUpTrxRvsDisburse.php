<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Database\QueryException;
use Throwable;

class SpFmsUpTrxRvsDisburse
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_rvs_disburse';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . "  :clientId, :accountNo, :trxDate, :remarks, :userId, :idMsg, :idRvs";

        // Start a database transaction.
        DB::beginTransaction();

        try {
            // Execute the statement using Laravel's database query builder and capture the result.
            $result = DB::statement($sql, $data);

            // If we reach this point, it means there was no error and we can commit the transaction.
            DB::commit();

            // Return successful result or true.
            return ['success' => true, 'result' => $result];
        } catch (QueryException $e) {
            // If there is a query exception, we will roll back the transaction.
            DB::rollBack();

            // You can log the error if needed.
            // Log::error($e->getMessage());

            // Now you can throw the error to be caught by the global exception handler or handle it as you wish.
            // Return the error message.
            $errorInfo = $e->errorInfo;

            // Filter out every third element starting from the first (indexes 0, 3, 6, ...)
            $filteredErrorInfo = array_values(array_filter(
                $errorInfo,
                function ($key) {
                    return $key % 3 !== 0;
                },
                ARRAY_FILTER_USE_KEY
            ));

            // Now, chunk the remaining elements into pairs of two
            $errorPairs = array_chunk($filteredErrorInfo, 2);

            // Use the error pairs as required
            return ['success' => false, 'error' => $errorPairs];
        } catch (Throwable $e) {
            // This catches any other exceptions that might be thrown.
            DB::rollBack();

            $errorInfo = $e->errorInfo;

            // Filter out every third element starting from the first (indexes 0, 3, 6, ...)
            $filteredErrorInfo = array_values(array_filter(
                $errorInfo,
                function ($key) {
                    return $key % 3 !== 0;
                },
                ARRAY_FILTER_USE_KEY
            ));

            // Now, chunk the remaining elements into pairs of two
            $errorPairs = array_chunk($filteredErrorInfo, 2);

            // Use the error pairs as required
            return ['success' => false, 'error' => $errorPairs];
        }
    }
}