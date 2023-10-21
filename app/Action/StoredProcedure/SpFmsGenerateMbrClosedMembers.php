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
        $result = DB::connection('fms')->select($sql, [
            'clientId' => $clientId,
            'refNo' => $refNo
        ]);

        // Check if the result has an unnamed property (uncommon) and return it if present
        if (isset($result[0]->{""})) {
            return $result[0]->{""};
        }

        // Return null if no result found
        return null;
    }
}