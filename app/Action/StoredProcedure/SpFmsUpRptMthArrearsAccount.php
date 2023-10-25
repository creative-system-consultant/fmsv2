<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthArrearsAccount
{
    public static function getRawData($input)
    {
    return DB::select("RPT.up_rpt_mth_arrears_account :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'MEMBER NO' => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'IDENTITY NO' => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'CURRENT_EMPLOYER NAME' => [
                'value' => $data->current_employer_name,
                'align' => 'right'
            ],
            'PAYMENT TYPE' => [
                'value' => $data->payment_type,
                'align' => 'right'
            ],
            'ACCOUNT_NO' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'PRODUCT' => [
                'value' =>$data->product,
                'align' => 'right'
            ],
            'BALANCE OUT' => [
                'value' => $data->number_format($data->balance_outs, 2),
                'align' => 'right'
            ],
            'PRINS OUTSTANDING' => [
                'value' => number_format($data->prin_outstanding, 2),
                'align' => 'right'
            ],
            'UEI OUTSTANDING' => [
                'value' => number_format($data->uei_outstanding, 2),
                'align' => 'right'
            ],
            'MONTH ARREARS' => [
                'value' => number_format($data->month_arrears, 2),
                'align' => 'right'
            ],
            'MISC AMT' => [
                'value' => number_format($data->misc_amt, 2),
                'align' => 'right'
            ],
            'ADVANCE PAYMENT' => [
                'value' => number_format($data->advance_payment, 2),
                'align' => 'right'
            ],
            'INSTALL ARREARS' => [
                'value' => number_format($data->instal_arrears, 2),
                'align' => 'right'
            ],
            'GUARANTOR1 IC_NO' => [
                'value' =>$data->Guarantor1_IcNo,
                'align' => 'right'
            ],
            'GUARANTOR1 MBR_NO' => [
                'value' =>$data->Guarantor1_mbr_no,
                'align' => 'right'
            ],
            'GUARANTOR 1' => [
                'value' =>$data->Guarantor1,
                'align' => 'right'
            ],
            'GUARANTOR2 IC_NO' => [
                'value' =>$data->Guarantor2_IcNo,
                'align' => 'right'
            ],
            'GUARANTOR2 MBR_NO' => [
                'value' =>$data->Guarantor2_mbr_no,
                'align' => 'right'
            ],
            'GUARANTOR 2' => [
                'value' =>$data->Guarantor2,
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