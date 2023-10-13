<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsFinancingDisbursement
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_fin_disbursement :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
    }
}