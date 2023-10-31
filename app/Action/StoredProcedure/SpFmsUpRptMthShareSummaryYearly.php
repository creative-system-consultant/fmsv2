<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthShareSummaryYearly
{
    public static function getRawData($input)
    {
        return DB::select("RPT.UP_RPT_SHARE_SUMMARY_YEARLY :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'MONTH' => [
                'value' => $data->bulan,
                'align' => 'left'
            ],
            'OPENING BALANCE' => [
                'value' => number_format($data->opening_balance, 2),
                'align' => 'right'
            ],
            'PAYMENT IN' => [
                'value' => number_format($data->payment_in, 2),
                'align' => 'right'
            ],
            'PAYMENT OUT' => [
                'value' => number_format($data->payment_out, 2),
                'align' => 'right'
            ],
            'CLOSING BALANCE' => [
                'value' => number_format($data->closing_balance, 2),
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