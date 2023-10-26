<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptRetirementList
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_list_retirement :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'   => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'IC NO'  => [
                'value' => $data->identity_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'MEMBERS STATUS' => [
                'value' => $data->status,
                'align' => 'left'
            ],
            'TOTAL CONTRIBUTION' => [
                'value' => sprintf("%40s",$data->total_contribution),
                'align' => 'right'
            ],
            'TOTAL SHARE' => [
                'value' => sprintf("%40s",$data->total_share),
                'align' => 'right'
            ],
            'NOTICED RETIREMENT DATE' => [
                'value' => $data->notice_date,
                'align' => 'right'
            ],
            'EFFECTIVE RETIREMENT DATE' => [
                'value' => $data->effective_retirement_date,
                'align' => 'right'
            ],
            'REMARKS' => [
                'value' => $data->remarks,
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