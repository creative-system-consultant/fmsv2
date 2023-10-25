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
            'MEMBER NO' => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'IDENTITY NO' => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'STAFF NO' => [
                'value' => $data->staff_no,
                'align' => 'right'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'PAYMENT' => [
                'value' => number_format($data->payment, 0),
                'align' => 'right'
            ],
            'WITHDRAWAL' => [
                'value' => number_format($data->withdrawal, 0),
                'align' => 'right'
            ],
            'TOTAL AMOUNT' => [
                'value' => number_format($data->total_amount, 0),
                'align' => 'right'
            ],
            'REPORT DATE' => [
                'value' => date('d-m-Y', strtotime($data->report_date)),
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