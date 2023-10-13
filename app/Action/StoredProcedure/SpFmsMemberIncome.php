<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsMemberIncome
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_members_bystate :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
    }
}