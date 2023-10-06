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
        <x-card title="Beneficiary Information 1" >
            <x-slot name="action" >
                <div class="flex items-center space-x-2">
                    <x-checkbox 
                        id="left-label" 
                        left-label="Nominee" 
                        wire:model.defer="" 
                    />
                    <x-button icon="trash" red label="delete" sm />
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-2">
                <x-input 
                    label="Name" 
                    wire:model=""
                    disabled
                />
            </div>
            <div class="grid grid-cols-2 gap-2 mt-2">

                <x-native-select label="Identity Type" wire:model="" disabled>
                    <option></option>
                </x-native-select>

                <x-native-select label="Identity No" wire:model="" disabled>
                    <option></option>
                </x-native-select>

                <x-native-select label="Race" wire:model="" disabled>
                    <option></option>
                </x-native-select>

                <x-native-select label="Religion" wire:model="" disabled>
                    <option></option>
                </x-native-select>

                <x-native-select label="Relation" wire:model="" disabled>
                    <option></option>
                </x-native-select>

                <x-input 
                    label="Contact No." 
                    wire:model=""
                    disabled
                />

                <x-input 
                    label="Employer Name." 
                    wire:model=""
                    disabled
                />

                <x-input 
                    label="Position." 
                    wire:model=""
                    disabled
                />

                <x-input 
                    label="Salary." 
                    wire:model=""
                    disabled
                />

            </div>
        </x-card>
        <! -- End loop -->
    </div>
</div>
