<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptGlBankRecon
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_gl_bank_recon :clientId, :reportDate, :bank_koputra", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBER NO'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'STAFF NO'  => [
                'value' =>  $data->staff_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'IDENTITY NO' => [
                'value' => $data->identity_no,
                'align' => 'left'
            ],
            'DATE' => [
                'value' =>  date('d-m-Y', strtotime($data->tarikh)),
                'align' => 'left'
            ],
            'DEBIT AMOUNT' => [
                'value' => number_format($data->debit_amt, 2),
                'align' => 'right'
            ],
            'CREDIT AMOUNT'  => [
                'value' => number_format($data->credit_amt, 2),
                'align' => 'right'
            ],
            'REMARKS' => [
                'value' => $data->remarks,
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