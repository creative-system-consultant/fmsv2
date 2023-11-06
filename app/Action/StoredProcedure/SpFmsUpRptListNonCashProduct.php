<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptListNonCashProduct
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_list_non_cash_products :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'   => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'IDENTITY NO'  => [
                'value' => $data->identity_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'PRODUCTS' => [
                'value' => $data->products,
                'align' => 'left'
            ],
            'ACCOUNT NO' => [
                'value' => $data->account_no,
                'align' => 'left'
            ],
            'APPROVED LIMIT' => [
                'value' => $data->approved_limit,
                'align' => 'left'
            ],
            'DISBURSED AMOUNT' => [
                'value' => $data->disbursed_amount,
                'align' => 'right'
            ],
            'BALANCE OUTSTANDING' => [
                'value' => $data->bal_outstanding,
                'align' => 'right'
            ],
            'STATUS' => [
                'value' => $data->status,
                'align' => 'left'
            ],
            'PROFIT RATE' => [
                'value' => $data->profit_rate,
                'align' => 'right'
            ],
            'DURATION' => [
                'value' => $data->duration,
                'align' => 'right'
            ],
            'PROFIT' => [
                'value' => $data->profit,
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