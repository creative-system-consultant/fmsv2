<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptAutopayList
{   
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_autopay_list :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MBR_NO' => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'DOC_NO' => [
                'value' => $data->doc_no,
                'align' => 'right'
            ],
            'TRANSACTION AMOUNT' => [
                'value' => number_format($data->trx_amt, 2),
                'align' => 'right'
            ],
            'TOTAL AMOUNT' => [
                'value' =>  number_format($data->total_amount, 2),
                'align' => 'right'
            ],
            'REMARKS' => [
                'value' => $data->remarks,
                'align' => 'right'
            ],
            'TRANSACTION DATE' => [
                'value' => date('d-m-Y', strtotime($data->transaction_date)),
                'align' => 'right'
            ],
            'TYPE OF PAYMENT' => [
                'value' => $data->type_of_payment,
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