<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsFinancingCashDetail
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_fin_disbursement_cash :clientId, :startDate, :endDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'MEMBER NO' => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'ACCOUNT NO' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'PRODUCT' => [
                'value' => $data->product,
                'align' => 'right'
            ],
            'PERCENTAGES' => [
                'value' => $data->percentages,
                'align' => 'right'
            ],
            'PERIOD' => [
                'value' => $data->period,
                'align' => 'right'
            ],
            'AMOUNT' => [
                'value' => number_format($data->amount, 2), 
                'align' => 'right'
            ],
            'APPROVED AMOUNT' => [
                'value' => number_format($data->approved_amount, 2),
                'align' => 'right'
            ],
            'SETTLE PROFIT' => [
                'value' => $data->settle_profit,
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