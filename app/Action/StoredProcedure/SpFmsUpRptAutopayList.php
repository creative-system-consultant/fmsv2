<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpRptAutopayList
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_autopay_list :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield [
                'mbr_id'            => $data->mbr_id,
                'name'              => $data->name,
                'doc_no'            => $data->doc_no,
                'trx_amt'           => number_format($data->trx_amt, 2),
                'total_amount'      => number_format($data->total_amount, 2),
                'remarks'           => $data->remarks,
                'transaction_date'  => date('d-m-Y', strtotime($data->transaction_date)),
                'type_of_payment'   => $data->type_of_payment,
            ];
        }
    }
}