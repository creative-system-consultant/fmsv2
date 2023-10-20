<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpUpRptSummaryTotalcontribution
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_summary_totalcontribution :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->mbrno,
                'align' => 'left'
            ],
            'Identity No' => [
                'value' => $data->identityno,
                'align' => 'right'
            ],
            'Name' => [
                'value' => $data->mbrname,
                'align' => 'right'
            ],
            'Opening' => [
                'value' => $data->opening,
                'align' => 'right'
            ],
            'Payment' => [
                'value' =>$data->payment,
                'align' => 'right'
            ],
            'Withrawal' => [
                'value' =>$data->withrawal,
                'align' => 'right'
            ],
            'Dividen' => [
                'value' =>$data->dividen,
                'align' => 'right'
            ],
            'Total Contribution'    => [
                'value' => number_format($data->total_contribution,2),
                'align' => 'right'
            ],
            'Closing' => [
                'value' =>$data->closing,
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