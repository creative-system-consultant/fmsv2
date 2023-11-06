<?php

namespace App\Action\StoredProcedure;
use Illuminate\Support\Collection;

use DB;

class SpFmsUpRptBankList
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_list_of_bank :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'Third Parties' => [
                'value' => $data->third_parties,
                'align' => 'left'
            ],
            'Transaction Amount' => [
                'value' =>  number_format($data->transaction_amt, 2),
                'align' => 'right'
            ],
            'Transaction Mode' => [
                'value' =>$data->transaction_mode,
                'align' => 'right'
            ],
            'Status' => [
                'value' =>$data->status,
                'align' => 'right'
            ],
            'Mode' => [
                'value' =>$data->mode,
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

    public static function handleForTable($input, $format = false)
    {
        $rawData = self::getRawData($input);
        $formattedData = [];
        foreach ($rawData as $data) {
            $formattedData[] = $format ? self::formatData($data) : $data;
        }
        return new Collection($formattedData);
    }
}