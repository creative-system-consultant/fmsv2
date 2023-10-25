<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptEntranceFeeList
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_list_entrance_fee :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'   => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'ENTRANCE FEE' => [
                'value' => $data->entrance_fee,
                'align' => 'right'
            ],
            'START DATE' => [
                'value' => date('d-m-Y', strtotime($data->start_date)),
                'align' => 'left'
            ],
            'STATUS' => [
                'value' => $data->status,
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