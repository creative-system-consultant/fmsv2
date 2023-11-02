<?php

namespace App\Traits\Reversal;

trait DisbursementPlaceholder
{
    public function placeholder()
    {
        $headerRows = '';
        $tableRows = '';

        for ($x = 1; $x <= 9; $x++) {
            $headerRows .= '
            <th><div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div></th>
            ';
        }

        for ($x = 1; $x <= 10; $x++) {
            $tableRow = '<tr>';
            for ($i = 1; $i <= 9; $i++) {
                $tableRow .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div></td>';
            }
            $tableRow .= '</tr>';
            $tableRows .= $tableRow;
        }

        return <<<HTML
        <div>
            <style>
                table td{
                    padding-top:6px;
                    padding-bottom:6px;
                }
            </style>
            <div class="grid grid-cols-1 ">
                <div class="flex flex-col w-full bg-white rounded-lg shadow-md dark:bg-secondary-800">
                    <div class="px-4 py-2.5 flex justify-between items-center border-b dark:border-0 ">
                        <h3 class="font-medium whitespace-normal text-md text-secondary-700 dark:text-primary-500">
                            DISBURSEMENT REVERSAL
                        </h3>
                    </div>
                    <div class="px-2 py-5 md:px-4 animate-pulse">
                        <div class="flex items-center space-x-2">
                            <div class="h-2 bg-gray-300 rounded-md dark:bg-gray-600 w-12 mb-2.5"></div>
                            <div class="h-7 bg-gray-300 rounded-md dark:bg-gray-600 w-40 mb-2.5"></div>
                            <div class="h-7 bg-gray-300 rounded-md dark:bg-gray-600 w-52 mb-2.5"></div>
                        </div>
                        <div class="flex flex-col mt-4 overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    {$headerRows}
                                </thead>
                                <tbody>
                                    {$tableRows}
                                </tbody>
                            </table>
                        </div>
                        <div class="flex items-center justify-between mt-4 space-x-5">
                            <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                            <div class="h-8 bg-gray-300 rounded-md dark:bg-gray-600 w-96"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    HTML;
    }
}