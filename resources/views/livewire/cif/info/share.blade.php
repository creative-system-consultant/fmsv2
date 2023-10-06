<div>
    <x-card title="Contribution Information">
        <div class="grid grid-cols-3 gap-2">
            <x-input  label="Total" wire:model="" disabled />
            <x-input  label="Last Purchase Amount" wire:model="" disabled />
            <x-input  label="Last Purchase Date" wire:model="" disabled />
            <x-input  label="Monthly" wire:model="" disabled />
            <x-input  label="Last Selling Amount" wire:model="" disabled />
            <x-input  label="Last Selling Date" wire:model="" disabled />
        </div>
    </x-card>

    <div class="mt-6">
        <x-card title="Share Statements">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <x-input type="date"  label="Start Date" value="" wire:model=""/>
                    <x-input type="date"  label="End Date" value="" wire:model=""/>
                </div>

                <div class="mt-5">
                    <x-button sm icon="document-report" green label="Excel"/>
                    <x-button sm icon="document-report" orange label="PDF" />
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
</div>
