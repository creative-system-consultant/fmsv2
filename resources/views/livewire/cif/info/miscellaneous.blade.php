<div>
    <div class="grid grid-cols-1">
        <x-card title="Miscellaneous Info" >
            <div class="flex mt-1 mb-2 rounded-md gap-2">
                <x-input wire:model="" label="Total" disabled />
                <x-input wire:model="" label="Last Payment Amount" disabled />
                <x-input wire:model="" label="Last Withdrawal Amount" disabled />
                <x-input wire:model="" label="Last Payment Date" disabled />
                <x-input wire:model="" label="Last Withdrawal Date"  disabled/>
            </div>
        </x-card>

        <div class="mt-6">
            <x-card title="Miscellaneous Statement" >
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <x-input type="date"  label="Start Date" value="" wire:model=""/>
                            <x-input type="date"  label="End Date" value="" wire:model=""/>
                        </div>
                    
                        <div class="flex items-center space-x-2">
                            <div class="mt-6">
                                <x-button sm icon="document-report" green label="Excel"/>
                                <x-button sm icon="document-report" orange label="PDF" />
                            </div>
                        </div>
                    </div>
                    
                    <x-table.table style="width:100%">
                        
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                            <x-table.table-header class="text-left" value="TRANSACTION  DATE" sort="" />
                            <x-table.table-header class="text-left" value="DOCUMENT NO" sort="" />
                            <x-table.table-header class="text-left" value="AMOUNT" sort="" />
                            <x-table.table-header class="text-left" value="TOTAL AMOUNT" sort="" />
                            <x-table.table-header class="text-left" value="REMARKS" sort="" />
                            <x-table.table-header class="text-left" value="CREATED BY" sort="" />
                            <x-table.table-header class="text-left" value="CREATED AT" sort="" />
                            <x-table.table-header class="text-left" value="ACTION" sort="" />


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
                </div>
            </x-card>
        </div>
    </div>

</div>


