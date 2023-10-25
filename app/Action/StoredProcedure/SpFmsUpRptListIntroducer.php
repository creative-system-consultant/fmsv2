<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptListIntroducer
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_list_introducer :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'APPLICANT MEMBERSHIP NO'   => [
                'value' => $data->applicant_mbr_no,
                'align' => 'left'
            ],
            'APPLICANT NAME' => [
                'value' => $data->applicant_name,
                'align' => 'left'
            ],
            'INTRODUCER MEMBERSHIP NO' => [
                'value' => $data->introducer_mbr_no,
                'align' => 'left'
            ],
            'INTRODUCER NAME' => [
                'value' => $data->introducer_name,
                'align' => 'left'
            ],
            'INTRODUCER BANK ACCOUNT NO' => [
                'value' => $data->introducer_bank_account_no,
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