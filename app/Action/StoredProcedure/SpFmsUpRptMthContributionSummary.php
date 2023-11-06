<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthContributionSummary
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_monthly_contribution_summary :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'PAYMENT01' => [
                'value' => number_format($data->payment01, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL01' => [
                'value' => number_format($data->withdrawal01, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT01' => [
                'value' => number_format($data->total_amount01, 2),
                'align' => 'left'
            ],
            'PAYMENT02' => [
                'value' => number_format($data->payment02, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL02' => [
                'value' => number_format($data->withdrawal02, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT02' => [
                'value' => number_format($data->total_amount02, 2),
                'align' => 'left'
            ],
            'PAYMENT03' => [
                'value' => number_format($data->payment03, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL03' => [
                'value' => number_format($data->withdrawal03, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT03' => [
                'value' => number_format($data->total_amount03, 2),
                'align' => 'left'
            ],
            'PAYMENT04' => [
                'value' => number_format($data->payment04, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL04' => [
                'value' => number_format($data->withdrawal04, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT04' => [
                'value' => number_format($data->total_amount04, 2),
                'align' => 'left'
            ],
            'PAYMENT05' => [
                'value' => number_format($data->payment05, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL05' => [
                'value' => number_format($data->withdrawal05, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT05' => [
                'value' => number_format($data->total_amount05, 2),
                'align' => 'left'
            ],
            'PAYMENT06' => [
                'value' => number_format($data->payment06, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL06' => [
                'value' => number_format($data->withdrawal06, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT06' => [
                'value' => number_format($data->total_amount06, 2),
                'align' => 'left'
            ],
            'PAYMENT07' => [
                'value' => number_format($data->payment07, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL07' => [
                'value' => number_format($data->withdrawal07, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT07' => [
                'value' => number_format($data->total_amount07, 2),
                'align' => 'left'
            ],
            'PAYMENT08' => [
                'value' => number_format($data->payment08, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL08' => [
                'value' => number_format($data->withdrawal08, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT08' => [
                'value' => number_format($data->total_amount08, 2),
                'align' => 'left'
            ],
            'PAYMENT09' => [
                'value' => number_format($data->payment09, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL09' => [
                'value' => number_format($data->withdrawal09, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT09' => [
                'value' => number_format($data->total_amount09, 2),
                'align' => 'left'
            ],
            'PAYMENT10' => [
                'value' => number_format($data->payment10, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL10' => [
                'value' => number_format($data->withdrawal10, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT10' => [
                'value' => number_format($data->total_amount10, 2),
                'align' => 'left'
            ],
            'PAYMENT11' => [
                'value' => number_format($data->payment11, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL11' => [
                'value' => number_format($data->withdrawal11, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT11' => [
                'value' => number_format($data->total_amount11, 2),
                'align' => 'left'
            ],
            'PAYMENT12' => [
                'value' => number_format($data->payment12, 2),
                'align' => 'left'
            ],
            'WITHDRAWAL12' => [
                'value' => number_format($data->withdrawal12, 2),
                'align' => 'left'
            ],
            'TOTAL_AMOUNT12' => [
                'value' => number_format($data->total_amount12, 2),
                'align' => 'left'
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
