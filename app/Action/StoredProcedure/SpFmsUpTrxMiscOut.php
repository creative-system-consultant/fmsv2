<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxMiscOut
{
    public function __construct()
    {
        //
    }

    /**
     * Execute the stored procedure with the provided data.
     *
     * @param array $data Associative array of parameters to be passed to the stored procedure.
     * @return bool Indicates whether the statement was executed successfully.
     */
    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_misc_out';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "SET NOCOUNT ON; exec " . $sp . " :clientId, :mbrNo, :txnAmt, :txnDate, :type, :remarks, :docNo, :userId, :bankCustomer, :accNo, :instiCode, :bankClient";

        dd($data);
        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::connection('fms')->statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}