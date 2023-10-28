<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUploadAutopayFromEmployer
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.upload_autopay_from_employer';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . "  :clientId, :txnDate, :code";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::connection('fms')->statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}