<div>
    <x-card title="Others Payment">
        <x-slot name="action">
            <div class="text-right">
                <x-button squared primary label="Excel" />
                <x-button squared primary label="PDF" />
            </div>
        </x-slot>
        
        <div class="flex gap-6">
            <div>
                <x-label class="block text-sm font-semibold leading-5 text-gray-700" label="Start Date"/>
                <input type="date" value="" id="name=" class="lg:text-sm form-input py-1  px-4">
            </div>
            
            <div>
                <x-label class="block text-sm font-semibold leading-5 text-gray-700" label="End Date"/>
                <input type="date" value="" id="name=" class="lg:text-sm form-input py-1 px-4" >
            </div>
        </div>

        <div class="grid grid-cols-1 gap-x-2 gap-y-0 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 mt-5">
            
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION" sort="" />
                    <x-table.table-header class="text-left " value="DOCUMENT NO" sort="" />
                    <x-table.table-header class="text-left " value="REMARKS" sort="" />
                    <x-table.table-header class="text-left " value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left " value="CREATED BY" sort="" />
                    <x-table.table-header class="text-left " value="CREATED AT" sort="" />
                    <x-table.table-header class="text-left " value="ACTION" sort="" />
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
                </x-slot>
            </x-table.table>
        </div>
    </x-card>
</div>
