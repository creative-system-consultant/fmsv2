<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpRptMembersDormant
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_members_dormant :clientId, :reportDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
    }
}