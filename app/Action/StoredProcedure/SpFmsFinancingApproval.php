<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsFinancingApproval
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_financing_approval :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
    }
}