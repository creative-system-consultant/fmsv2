<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptShareRedemption
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_share_redemption :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'Staff No'  => [
                'value' =>  $data->staff_no,
                'align' => 'left'
            ],
            'Identity No'  => [
                'value' =>  $data->identity_no,
                'align' => 'left'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'Transaction' => [
                'value' => $data->transactions,
                'align' => 'right'
            ],
            'Amount' => [
                'value' =>$data->amount,
                'align' => 'right'
            ],
            'Transaction Date'     => [
                'value' => date('d-m-Y', strtotime($data->transaction_date)),
                'align' => 'right'
            ],
            'Doc No' => [
                'value' => $data->doc_no,
                'align' => 'right'
            ],
            'Remarks' => [
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