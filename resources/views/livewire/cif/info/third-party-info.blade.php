<div>
    <x-card title="Third Party Information">
        <x-slot name="action">
        
            <x-button icon="plus" squared primary label="Create" />
            
        </x-slot>

        <p>Listing</p>

        <div class="grid grid-cols-1 gap-x-2 gap-y-0" style="margin-top: 20px;">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="INSTITUTION ID" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="EFECTIVE DATE" sort="" />
                    <x-table.table-header class="text-left " value="EXPIRY DATE" sort="" />
                    <x-table.table-header class="text-left " value="PRIORITY" sort="" />
                    <x-table.table-header class="text-left " value="PAYMENT MODE" sort="" />
                    <x-table.table-header class="text-left " value="REMARKS" sort="" />
                    <x-table.table-header class="text-left " value="STATUS" sort="" />
                    <x-table.table-header class="text-left " value="CREATED BY" sort="" />
                    <x-table.table-header class="text-left " value="CREATED AT" sort="" />
                    <x-table.table-header class="text-left " value="Action" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        1
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        2
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        3
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        4
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        5
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        6
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        7
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        8
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        9
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        10
                    </x-table.table-body>

                    <x-table.table-body colspan="1" class="text-left">
                        <x-button squared primary label="Statement" />
                        <x-button squared warning label="Edit" />
                        <x-button squared negative label="Delete" />
                    </x-table.table-body>
                </x-slot>
            </x-table.table>
        </div>
    </x-card>
</div>
