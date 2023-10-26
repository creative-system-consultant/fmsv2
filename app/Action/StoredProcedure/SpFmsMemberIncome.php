<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsMemberIncome
{
    
    public static function getRawData($input)
    {
        return DB::select("rpt.up_rpt_members_byincome :clientId, :startDate, :endDate", $input);
    }
        public static function formatData($data)
        {
            return [
                'MEMBER NO'  => [
                    'value' =>  $data->mbr_no,
                    'align' => 'left'
                ],
                'STAFF NO' => [
                    'value' => $data->staff_no,
                    'align' => 'left'
                ],
                'NAME' => [
                    'value' => $data->name,
                    'align' => 'left'
                ],
                'TOTAL SHARE' => [
                    'value' => number_format($data->total_share,2),
                    'align' => 'right'
                ],
                'TOTAL CONTRIBUTION' => [
                    'value' => number_format($data->total_contribution,2),
                    'align' => 'right'
                ],
                'MONTHLY CONTRIBUTION' => [
                    'value' => number_format($data->monthly_contribution,2),
                    'align' => 'right'
                ],
                'GENDER ID' => [
                    'value' =>  $data->gender_id,
                    'align' => 'left'
                ],
                'RACE ID'  => [
                    'value' => $data->race_id,
                    'align' => 'left'
                ],
                'RELIGION ID' => [
                    'value' => $data->religion_id,
                    'align' => 'left'
                ],
                'MARITAL ID' => [
                    'value' => $data->marital_id,
                    'align' => 'left'
                ],
                'PHONE NO'   => [
                    'value' => $data->phone,
                    'align' => 'left'
                ],
                'RESIDENT PHONE NO' => [
                    'value' => $data->resident_phone,
                    'align' => 'left'
                ],
                'CURRENT EMPLOYER NAME' => [
                    'value' => $data->current_employer_name,
                    'align' => 'left'
                ],
                'CURRENT EMPLOYMENT DATE' => [
                    'value' => date('d-m-Y', strtotime($data->current_employment_date)),
                    'align' => 'left'
                ],
                'COMPANY ADDRESS' => [
                    'value' => $data->company_address,
                    'align' => 'left'
                ],
                'JOB POSITION' => [
                    'value' => $data->job_position,
                    'align' => 'left'
                ],
                'CURRENT SALARY' => [
                    'value' => number_format($data->current_salary,2),
                    'align' => 'right'
                ],
                'JOB GROUP ID' => [
                    'value' => $data->job_group_id,
                    'align' => 'left'
                ],
                'JOB STATUS ID' => [
                    'value' => $data->job_status_id,
                    'align' => 'left'
                ],
                'COMPANY PHONE NO' => [
                    'value' => $data->company_phone_no,
                    'align' => 'left'
                ],
                'STATUS ID'   => [
                    'value' => $data->status_id,
                    'align' => 'left'
                ],
                'APPROVED RETIREMENT DATE' => [
                    'value' => date('d-m-Y', strtotime($data->approved_retirement_date)),
                    'align' => 'left'
                ],
                'EFFECTIVE RETIREMENT DATE' => [
                    'value' => date('d-m-Y', strtotime($data->effective_retirement_date)),
                    'align' => 'left'
                ],
                'SPOUSE NAME' => [
                    'value' => $data->spounse_name,
                    'align' => 'left'
                ],
                'SPOUSE IC NO'   => [
                    'value' =>  $data->spounse_icNo,
                    'align' => 'left'
                ],
                'ADDRESS_1' => [
                    'value' => $data->add1,
                    'align' => 'left'
                ],
                'ADDRESS_2' => [
                    'value' => $data->add2,
                    'align' => 'left'
                ], 
                'ADDRESS_3' => [
                    'value' => $data->add3,
                    'align' => 'left'
                ],
                'POSTCODE' => [
                    'value' => $data->postcode,
                    'align' => 'left'
                ],
                'TOWN' => [
                    'value' => $data->town,
                    'align' => 'left'
                ],
                'STATE ID' => [
                    'value' => $data->state_id,
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