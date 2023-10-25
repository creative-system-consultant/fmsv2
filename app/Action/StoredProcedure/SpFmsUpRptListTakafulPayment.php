<?php

namespace App\Action\StoredProcedure;

use Illuminate\Support\Collection;
use DB;

class SpFmsUpRptListTakafulPayment
{
    public static function getRawData($input)
    {
        return DB::select("FMS.UP_RPT_LIST_OF_TAKAFUL_PAYMENT :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Member No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'Account No' => [
                'value' =>$data->account_no,
                'align' => 'left'
            ],
            'Balance Outstanding'  => [
                'value' => $data->bal_outstanding,
                'align' => 'right'
            ],
            'Print Outstanding'  => [
                'value' =>$data->prin_outstanding,
                'align' => 'right'
            ],
            'Uei Outstanding'  => [
                'value' =>$data->uei_outstanding,
                'align' => 'right'
            ],
            'Month Arrears' => [
                'value' =>$data->month_arrears,
                'align' => 'right'
            ],
            'Installment Arrears' => [
                'value' =>$data->instal_arrears,
                'align' => 'right'
            ],
            'Payment Type' => [
                'value' =>$data->payment_type,
                'align' => 'left'
            ],
            'NPF Status' => [
                'value' =>$data->npf_status,
                'align' => 'left'
            ],
            'Product' => [
                'value' =>$data->product,
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