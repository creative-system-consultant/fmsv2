<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsDailyTransactionList
{
    public static function handle($input)
    {
        $rawData = DB::select("FMS.up_rpt_daily_trx :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield [
                'Member ID'                 => $data->mbr_id,
                'Name'                      => $data->name,
                'Account No'                => $data->account_no,
                'Debit'                     => number_format($data->debit,2),
                'Credit'                    => number_format($data->kredit,2),
                'Total Amount'              => number_format($data->total_amount,2),
                'Transaction Date'          => date('d-m-Y', strtotime($data->transaction_date)),
                'Transaction Code'          => $data->transaction_code_id,
                'Institution Code'          => $data->institution_code,
                'Bank'                      => $data->bank_id,
                'Bank Account No.'          => $data->bank_acctno,
                'Cheque No.'                => $data->cheque_no,
                'Cheque Date'               => $data->cheque_date,
                'Doc No.'                   => $data->doc_no,
                'Bank Koputra'              => $data->bank_koputra,
                'Remarks'                   => $data->remarks,
                'Created By'                => $data->created_by,
                'Created At'                => date('d-m-Y', strtotime($data->created_at)),
            ];
        }
    }
}