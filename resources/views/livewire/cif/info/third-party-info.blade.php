<div>
    <x-card title="Third Party Information">
        <x-slot name="action">
            <x-button onclick="$openModal('create-tp')" icon="plus" primary label="Create" sm />
        </x-slot>
        <! -- start create third party modal -->
        <x-modal.card  title="Create Third Party" align="center"  wire:model.defer="create-tp">
            <div class="grid grid-cols-2 gap-4">
                <x-native-select label="Mode" wire:model="" >
                    <option></option>
                </x-native-select>

                <x-native-select label="Description" wire:model="" >
                    <option></option>
                </x-native-select>

                <x-input 
                    label="Trasaction Amount"
                    wire:model=""
                />

                <x-input 
                    label="Priority"
                    wire:model=""
                />

                <x-input 
                    label="Effective Date"
                    type="date"
                    wire:model=""
                />

                <x-input 
                    label="Expiry Date"
                    type="date"
                    wire:model=""
                />
            </div>
            <div class="grid grid-cols-1 mt-4">
                <x-textarea 
                    label="Remarks" 
                    wire:model=""  
                />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
        <! -- end create third party modal -->

        <div class="grid grid-cols-1  mt-2">
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
                        MUTIARA PLUS
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        10.00
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        1
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        NO EXPIRY
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        CLOSED
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        10
                    </x-table.table-body>

                    <x-table.table-body colspan="1" class="text-left">
                        <x-button  primary label="Statement" sm />
                        <x-button  onclick="$openModal('edit-tp')" warning label="Edit" sm />
                        <x-button  negative label="Delete" sm/>
                    </x-table.table-body>
                </x-slot>
            </x-table.table>
        </div>
    </x-card>
    <! -- start edit third party modal -->
    <x-modal.card  title="Edit Third Party" align="center"  wire:model.defer="edit-tp">
        <div class="grid grid-cols-2 gap-4">
            <x-native-select label="Mode" wire:model="" >
                <option></option>
            </x-native-select>

            <x-native-select label="Description" wire:model="" >
                <option></option>
            </x-native-select>

            <x-input 
                label="Trasaction Amount"
                wire:model=""
            />

            <x-input 
                label="Priority"
                wire:model=""
            />

            <x-input 
                label="Effective Date"
                type="date"
                wire:model=""
            />

            <x-input 
                label="Expiry Date"
                type="date"
                wire:model=""
            />
        </div>
        <div class="grid grid-cols-1 mt-4">
            <x-textarea 
                label="Remarks" 
                wire:model=""  
            />
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    <! -- end edit third party modal -->
    
</div>
