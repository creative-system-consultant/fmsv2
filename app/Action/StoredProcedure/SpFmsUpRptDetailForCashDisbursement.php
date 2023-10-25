<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptDetailForCashDisbursement
{
    public static function getRawData($input)
    {
        return DB::select("FMS.up_rpt_detail_for_cash_disbursement :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'NUM'   => [
                'value' => $data->num,
                'align' => 'left'
            ],
            'TRANSACTION DATE'   => [
                'value' => $data->disb_date,
                'align' => 'left'
            ],
            'MEMBERSHIP NO'   => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'MEMBER NAME' => [
                'value' => $data->mbr_name,
                'align' => 'left'
            ],
            'ACCOUNT NO' => [
                'value' => $data->account_no,
                'align' => 'left'
            ],
            'TRANSACTION CODE' => [
                'value' => $data->txn_code,
                'align' => 'left'
            ],
            'TRANSACTION DESCRIPTIONS' => [
                'value' => $data->txn_des,
                'align' => 'left'
            ],
            'CHEQUE NO' => [
                'value' => $data->cheque_no,
                'align' => 'right'
            ],
            'DEBIT' => [
                'value' => $data->debit,
                'align' => 'right'
            ],
            'CREDIT' => [
                'value' => $data->credit,
                'align' => 'right'
            ],
        ];
    }

    public static function formatDataForExcel($data)
    {
        $formattedData = self::formatData($data);
        $excelData = [];

        foreach ($formattedData as $column => $cell) {
            $excelData[$column] = $cell['value'];
        }

        return $excelData;
    }

    public static function handleForExcel($input, $format = false)
    {
        $rawData = self::getRawData($input);
        foreach ($rawData as $data) {
            $formattedData = $format ? self::formatDataForExcel($data) : $data;
            yield $formattedData;
        }
    }

    public static function handleForTable($rawData, $format = false)
    {
        $formattedData = [];
        foreach ($rawData as $data) {
            $formattedData[] = $format ? self::formatData($data) : $data;
        }
        return new Collection($formattedData);
    }
}