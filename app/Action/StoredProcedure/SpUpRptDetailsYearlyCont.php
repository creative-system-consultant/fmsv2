<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpUpRptDetailsYearlyCont
{
    public static function getRawData($input)
    {
        return DB::select("fms.UP_RPT_DETAILS_YEARLY_CONTRIBUTIONS :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->membership_no,
                'align' => 'left'
            ],
            'Identity No' => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'Staff No' => [
                'value' => $data->staff_no,
                'align' => 'right'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'Opening Balance'    => [
                'value' => number_format($data->opening_balance,2),
                'align' => 'right'
            ],
            'Payment In'    => [
                'value' => number_format($data->payment_in,2),
                'align' => 'right'
            ],
            'Payment Out'    => [
                'value' => number_format($data->payment_out,2),
                'align' => 'right'
            ],
            'Closing Balance'    => [
                'value' => number_format($data->closing_balance,2),
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