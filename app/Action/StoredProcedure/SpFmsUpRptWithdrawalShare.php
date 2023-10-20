<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptWithdrawalShare
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_withdrawal_share :clientId, :startDate, :endDate", $input);
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
                'align' => 'right'
            ],
            'Transaction Id' => [
                'value' => $data->transaction_code_id,
                'align' => 'right'
            ],
            'Description' => [
                'value' => $data->descriptions,
                'align' => 'right'
            ],
            'amount' => [
                'value' =>$data->amount,
                'align' => 'right'
            ],
            'Total Amount'    => [
                'value' => number_format($data->total_amount,2),
                'align' => 'right'
            ],
            'Transaction Date'     => [
                'value' => date('d-m-Y', strtotime($data->transaction_date)),
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