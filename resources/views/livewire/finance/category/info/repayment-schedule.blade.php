<div>
    <div class=" grid grid-cols-1">
        <x-card title="Repayment Schedule" >
            <x-slot name="action">
                <div>
                    <x-button sm icon="document-report" green label="Excel" sm/>
                    <x-button sm icon="document-report" orange label="PDF" sm/>
                </div>
            </x-slot>
            <div>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="INSTALMENT NO." sort="" />
                        <x-table.table-header class="text-right" value="AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="DATE" sort="" />
                        <x-table.table-header class="text-right" value="BALANCE OUTS" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL OUTS" sort="" />
                        <x-table.table-header class="text-right" value="PROFIT" sort="" />
                        <x-table.table-header class="text-right" value="UEI OUTS" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                69
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                0.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                30/11/2016
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                17,419.53
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                0.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                15,852.85
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                0.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                1,566.68
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
    </div>
</div>
