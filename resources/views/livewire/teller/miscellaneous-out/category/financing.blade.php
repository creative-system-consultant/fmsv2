<div>
    <x-card title="Financing List">
        <div class="grid grid-cols-1 sgap-4">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Account No" sort="" />
                    <x-table.table-header class="text-left" value="Product" sort="" />
                    <x-table.table-header class="text-left" value="Installment Amount" sort="" />
                    <x-table.table-header class="text-left" value="Action" sort="" />
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
                            <x-button 
                                sm  
                                icon="plus" 
                                primary 
                                label="Select" 
                            />
                        </x-table.table-body>
                    </tr>
                </x-slot>
            </x-table.table>
        </div>
    </x-card>

    <div class="mt-6">
        <x-card title="Contribution">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-input 
                    label="Amount" 
                    wire:model=""
                />
                <x-input 
                    label="Transaction Date" 
                    type="date"
                    wire:model=""
                />
        
                <x-input 
                    label="Document No" 
                    wire:model=""
                />
            </div>
            <div class="grid grid-cols-1 gap-4 mt-4">
                <x-textarea label="Remarks" wire:model="" />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end items-center">
                    <x-button 
                        sm  
                        icon="clipboard-check" 
                        primary 
                        label="Pay" 
                    />
                </div>
            </x-slot>
        </x-card>
    </div>
</div>
