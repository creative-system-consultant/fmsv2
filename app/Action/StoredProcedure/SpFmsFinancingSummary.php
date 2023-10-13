<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsFinancingSummary
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_financing_summary :clientId, :rptDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
}
}