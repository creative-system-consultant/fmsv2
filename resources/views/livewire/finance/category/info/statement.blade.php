<div>
    <div class=" grid grid-cols-1"">
        <x-card title="Financing Statements" >
            <x-slot name="action">
                <div>
                    <x-button sm icon="document-report" green label="Excel" sm/>
                    <x-button sm icon="document-report" orange label="PDF" sm/>
                </div>
            </x-slot>
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <x-input type="date"  label="Start Date" value="" wire:model=""/>
                    <x-input type="date"  label="End Date" value="" wire:model=""/>
                </div>
            
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                        <x-table.table-header class="text-left" value="DOC NO" sort="" />
                        <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="REMARKS" sort="" />
                        <x-table.table-header class="text-right" value="AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="BAL OUTS" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL" sort="" />
                        <x-table.table-header class="text-right" value="PROFIT" sort="" />
                        <x-table.table-header class="text-right" value="UEI OUTS" sort="" />
                        <x-table.table-header class="text-right" value="ADV PAYMENT" sort="" />
                        <x-table.table-header class="text-left" value="CREATED BY" sort="" />
                        <x-table.table-header class="text-left" value="CREATED AT" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                31/12/2021
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                1231241234
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                Early Settlement - IBT
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                MIGRATION
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                0.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                17,419.53
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                0.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                1,566.68
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                1,566.68
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                0.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                2022-01-01 01:07:11
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                2022-01-01 01:07:11
                            </x-table.table-body>
                            
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
    </div>
</div>
