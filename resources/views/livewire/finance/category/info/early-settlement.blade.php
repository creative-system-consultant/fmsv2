<div>
    <div class=" grid grid-cols-1">
        <x-card title="Account Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Balance Outstanding" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Principal Outstanding" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="UEI Outstanding" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Month in Arrears" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Income Arrears" 
                    wire:model=""
                    disabled
                />
            </div>
            <div class="grid grid-cols-1 mt-6">
                <div class="flex items-center space-x-2">
                    <x-checkbox id="md" md wire:model="" />
                    <x-label label="Rebate Amount" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 mt-4">
                <x-input 
                    wire:model=""
                />
            </div>
        </x-card>

        <div class="mt-6">
            <x-card title="Settlement Information" >
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="SETTLEMENT DATE" sort="" />
                        <x-table.table-header class="text-right" value="SETTLEMENT AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="REBATE AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="PROFIT AMOUNT" sort="" />
                        <x-table.table-header class="text-center" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                2023-10-31
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                -1.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                1.00
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                -1.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <x-button 
                                    sm  
                                    icon="clipboard-check"
                                    primary 
                                    label="Confirmation" 
                                />
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </x-card>
        </div>
    </div>
</div>

