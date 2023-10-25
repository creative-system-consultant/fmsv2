<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptBskeGoldbarTrx
{
    public static function getRawData($input)
    {
        return DB::select("FMS.up_rpt_bske_gold_transactions :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'   => [
                'value' => $data->Membership_No,
                'align' => 'left'
            ],
            'IC NO'  => [
                'value' => $data->IC_No,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->Name,
                'align' => 'left'
            ],
            'TRANSACTIONS' => [
                'value' => $data->Transactions,
                'align' => 'left'
            ],
            'AMOUNT' => [
                'value' => $data->Amount,
                'align' => 'right'
            ],
            'TRANSACTION DATE' => [
                'value' => $data->Transaction_Date,
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