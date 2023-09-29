<div>
    <x-card title="Contribution Information">
        <div class="grid grid-cols-3 gap-3">
            <x-input  label="Total" placeholder="" />
            <x-input  label="Last Purchase Amount" placeholder="" />
            <x-input  label="Last Purchase Date" placeholder="" />
            <x-input  label="Monthly" placeholder="" />
            <x-input  label="Last Selling Amount" placeholder="" />
            <x-input  label="Last Selling Date" placeholder="" />
       </div>
    </x-card>

    <x-card title="Share Statements">
        <div class="grid grid-cols-3 gap-3">
            <x-input  type="date"  label="Start Date" value="" wire:model="" :editable=true/>
            <x-input  type="date"  label="End Date" value="" wire:model="" :editable=true/>

            <div>
            <x-button sm icon="document-report" blue label="Excel" class="margin-left: 50px;"/>
            <x-button sm icon="document-report" blue label="PDF" class="margin-left: 50px;"/>
            </div>

        </div>

        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="Date" sort="" />
                <x-table.table-header class="text-left" value="Doc No" sort="" />
                <x-table.table-header class="text-left" value="Transaction Description" sort="" />
                <x-table.table-header class="text-left " value="Remark" sort="" />
                <x-table.table-header class="text-left " value="Amount" sort="" />
                <x-table.table-header class="text-left " value="Total Amount" sort="" />
                <x-table.table-header class="text-left " value="Created By" sort="" />
                <x-table.table-header class="text-left " value="Created At" sort="" />
                <x-table.table-header class="text-left " value="Action" sort="" />
            </x-slot>
            <x-slot name="tbody">
                <tr>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                    </x-table.table-body>

                </tr>
            </x-slot>
        </x-table.table>

    </x-card>







</div>
