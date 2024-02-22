<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxSpecialAid
{
    /**
     * Execute the stored procedure with the provided data.
     *
     * @param array $data Associative array of parameters to be passed to the stored procedure.
     * @return bool Indicates whether the statement was executed successfully.
     */
    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.trx_special_aid';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . "  :clientId, :applyId, :mbrNo, :txnAmt, :docNo, :type, :txnDate, :txnCode, :remarks, :userId";

        // Execute the statement using Laravel's database query builder and capture the result.
        //dd($sql,$data);
        $result = DB::select($sql, $data);
        

        // Return the result of the statement execution.
        return $result;
    }
}