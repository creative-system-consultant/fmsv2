<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsDailyTransactionList
{
    public static function getRawData($input)
    {
        return DB::select("FMS.UP_RPT_TRX_DAILY_FINAL :clientId, :startDate, :endDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'MEMBER_ID' => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'ACCOUNT_NO' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'TRANSACTION DATE' => [
                'value' => date('Y-m-d', strtotime($data->transaction_date)) ?? 0,
                'align' => 'right'
            ],
            'TRANSACTION CODE ID' => [
                'value' =>  $data->transaction_code_id,
                'align' => 'right'
            ],
            'INSTITUTION CODE' => [
                'value' => $data->institution_code,
                'align' => 'right'
            ],
            'BANK ID' => [
                'value' =>  $data->bank_id,
                'align' => 'right'
            ],
            'CHEQUE NO' => [
                'value' => $data->cheque_no,
                'align' => 'right'
            ],
            'CHEQUE DATE' => [
                'value' => date('Y-m-d', strtotime($data->cheque_date)) ?? 0,
                'align' => 'right'
            ],
            'DOCUMENT NO' => [
                'value' => $data->doc_no,
                'align' => 'right'
            ],
            'DEBIT' => [
                'value' => $data->debit,
                'align' => 'right'
            ],
            'KREDIT' => [
                'value' => $data->kredit,
                'align' => 'right'
            ],
            'TOTAL AMOUNT' => [
                'value' =>number_format($data->total_amount, 2),
                'align' => 'right'
            ],
            'BANK ACCOUNT NO' => [
                'value' => $data->bank_acctno,
                'align' => 'right'
            ],
            'BANK KOPUTRA' => [
                'value' => $data->bank_koputra,
                'align' => 'right'
            ],
            'REMARKS' => [
                'value' => $data->remarks,
                'align' => 'right'
            ],
            'CREATED_BY' => [
                'value' => $data->created_by,
                'align' => 'right'
            ],
            'CREATED_AT' => [
                'value' => date('Y-m-d', strtotime($data->created_at)) ?? 0,
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