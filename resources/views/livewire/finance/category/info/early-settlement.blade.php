<div>
    <div class=" grid grid-cols-1">
        <x-card title="Account Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Balance Outstanding" 
                    wire:model=""
                    value="{{ number_format($accountPosition->bal_outstanding, 2) }}"
                    disabled
                />
                <x-input 
                    label="Principal Outstanding" 
                    wire:model=""
                    value="{{ number_format($accountPosition->prin_outstanding, 2) }}"
                    disabled
                />
                <x-input 
                    label="UEI Outstanding" 
                    wire:model=""
                    value="{{ number_format($accountPosition->uei_outstanding, 2) }}"
                    disabled
                />
                <x-input 
                    label="Month in Arrears" 
                    wire:model=""
                    value="{{ number_format($accountPosition->month_arrears, 2) }}"
                    disabled
                />
                <x-input 
                    label="Income Arrears" 
                    wire:model=""
                    value="{{ number_format($accountPosition->income_arrears, 2) }}"
                    disabled
                />
            </div>
            <div class="grid grid-cols-1 mt-6">
                <div class="flex items-center space-x-2">
                    <x-checkbox id="md" md wire:model="flag_rebate" wire:click="rebateAmountCheck" />
                    <x-label label="Rebate Amount" />
                </div>
            </div>
            @if($rebate_amount)

            <div class="grid grid-cols-1 md:grid-cols-3 mt-4 gap-x-2 items-center">
                <x-input 
                    wire:model="rebate_amt1"
                />
                <div class="w-64">
                    <x-button 
                        sm  
                        icon="clipboard-check"
                        primary 
                        label="Calculate" 
                        wire:click="calculate"
                />
                </div>
            </div>
            @endif
        </x-card>

        @if($calculated)

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
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-left">
                                <p>{{ $settlementDate }}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($settlementAmount, 2) }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($rebateAmount, 2) }}</p>
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($profitAmount, 2) }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center">
                                <x-button 
                                    sm  
                                    icon="clipboard-check"
                                    primary 
                                    label="Confirmation" 
                                    wire:click="confirmation"
                                />
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </x-card>
        </div>
        @endif

    </div>
</div>

