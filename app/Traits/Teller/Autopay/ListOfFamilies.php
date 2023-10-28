<?php

namespace App\Traits\Teller\Autopay;

trait ListOfFamilies
{
    public function placeholder()
    {
        $tableRows = '';

        for ($x = 0; $x <= 10; $x++) {
            $tableRows .= '<tr class="py-10">';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '<td><div class="w-32 h-2 bg-gray-200 rounded-full dark-bg-gray-700"></div></td>';
            $tableRows .= '</tr>';
        }

        return <<<HTML
        <div>
            <x-card title="LIST of Families (Autopay)">
                <div class="flex items-center justify-between space-x-2">
                    <div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div>
                </div>

                <div class="mt-4">
                    <table class="w-full ">
                        <tr class="py-2 ">
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                            <th><div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-24 mb-2.5"></div></th>
                        </tr>
                        {$tableRows}
                    </table>
                </div>

                <div class="flex justify-end mt-4">
                    <div class="h-2.5 bg-gray-300 rounded-full dark-bg-gray-600 w-full"></div>
                </div>
            </x-card>
        </div>
    HTML;
    }
}