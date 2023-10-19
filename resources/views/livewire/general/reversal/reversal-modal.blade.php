<div>
    <x-modal.card title="ADVANCE REVERSAL CONFIRMATION" align="center" fullscreen="true" blur wire:model.defer="reversal-modal">
        <div class="mb-4">
            <x-card title="Customer Information">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <x-input 
                        label="Name"  
                        wire:model="" 
                        disabled
                    />
                    <x-input 
                        label="Membership No"
                        wire:model=""  
                        disabled
                    />
                    <x-input 
                        label="Account No" 
                        wire:model="" 
                        disabled
                    />
                </div>
            </x-card>
        </div>
        
        <div class="mb-4">
            <x-card title="Transaction Information">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Amount"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model=""
                        disabled
                    />
                    <x-input 
                        label="Transaction Description" 
                        wire:model=""   
                        disabled
                    />
                    <x-input 
                        label="Document No"
                        wire:model=""   
                        disabled
                    />
                    <x-input 
                        label="remarks"
                        wire:model="" 
                        disabled
                    />
                    <x-input 
                        label="Trasaction Date" 
                        wire:model="" 
                        disabled
                    />
                </div>
            </x-card>
        </div>

        <div class="mb-4">
            <x-card title="List Of Overlap Account">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="OVERLAP ACCOUNT" sort=""  />
                        <x-table.table-header class="text-left" value="PRODUCTS" sort=""  />
                        <x-table.table-header class="text-right" value="SETTLEMENT AMOUNT" sort=""  />
                        <x-table.table-header class="text-right" value="PRINCIPAL AMOUNT" sort=""  />
                        <x-table.table-header class="text-right" value="PROFIT AMOUNT" sort=""  />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                OVERLAP ACCOUNT
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                PRODUCTS
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                SETTLEMENT AMOUNT
                            </x-table.table-body>
                            
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                PRINCIPAL AMOUNT
                            </x-table.table-body>
                            
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                PROFIT AMOUNT
                            </x-table.table-body>
                        </tr>
                        
                    </x-slot>
                </x-table.table>
            </x-card>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-2">
                <x-button flat label="Close" x-on:click="close" />
                <x-button primary label="Confirm" onclick="$openModal('remarks-modal')" />
            </div>
        </x-slot>
    </x-modal.card>

    <x-modal.card title="Are you sure you want to reverse this transaction?" align="center" max-width="2xl" blur wire:model.defer="remarks-modal">
        <div class="grid grid-cols-1 gap-2 p-3">
            <x-textarea 
                label="Remarks" 
                wire:model=""  
            />
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-2">
                <x-button flat label="Close" x-on:click="close" />
                <x-button red label="Reverse" />
            </div>
        </x-slot>
    </x-modal.card>

</div>
