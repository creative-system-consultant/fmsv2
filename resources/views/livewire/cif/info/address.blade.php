<div>
    <div class="flex items-center justify-between mb-5 ">
        <div>
            <x-button icon="plus" primary label="Add New" sm />
        </div>
        <div>
            <x-button icon="pencil" primary label="Edit" sm />
            <x-button icon="save" primary label="Save" sm/>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <! -- Start loop -->
        <x-card title="Address Detail 1" >
            <x-slot name="action" >
                <div class="flex items-center space-x-2">
                    <x-checkbox 
                        id="left-label" 
                        left-label="Mailing Address" 
                        wire:model.defer="" 
                    />
                    <x-button icon="trash" red label="delete" sm />
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-2">
                <x-input 
                    label="Address" 
                    placeholder="Address 1" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    placeholder="Address 2" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    placeholder="Address 3" 
                    wire:model=""
                    disabled
                />
            </div>
            <div class="grid grid-cols-1 gap-2 mt-2">
                <x-native-select label="Address Type" wire:model="" disabled>
                    <option></option>
                </x-native-select>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
                <x-input 
                    label="Postcode" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Town" 
                    wire:model=""
                    disabled
                />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
                <x-native-select label="State" wire:model="" disabled>
                    <option></option>
                </x-native-select>
                <x-native-select label="Country" wire:model="" disabled>
                    <option></option>
                </x-native-select>
            </div>
        </x-card>
        <! -- End loop -->
    </div>
</div>
