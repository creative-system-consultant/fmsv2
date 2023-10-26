<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsGenerateMbrClosedMembers
{
    public static function handle($clientId, $refNo)
    {
        // Define the stored procedure name
        $sp = 'FMS.generate_mbr_closed_members';

        // Construct the SQL command to execute the stored procedure
        $sql = "exec " . $sp . " :clientId, :refNo";

        // Execute the stored procedure and fetch the result
        $result = DB::connection('fms')->statement($sql, [
            'clientId' => $clientId,
            'refNo' => $refNo
        ]);
    }
}