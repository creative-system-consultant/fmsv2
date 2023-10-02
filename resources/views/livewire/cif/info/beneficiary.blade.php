{{-- <div>
    <x-button icon="plus" primary label="Add New" />
        <div class="text-right">
            <x-button icon="pencil" primary label="Edit" />
            <x-button icon="save" primary label="Save" />
        </div>
    <x-card title="Beneficiary Information 1" >
            
        <div class="grid grid-cols-3 gap-5" style="margin-bottom: 20px">
                <x-input  label="Name" placeholder="" />
                <x-input  label="Identity Type" placeholder="" />
                <x-input  label="Identity No" placeholder="" />
                <x-input  label="Race" placeholder="" />
                <x-input  label="Religion" placeholder="" />
                <x-input  label="Relation" placeholder="" />
                <x-input  label="Contact No" placeholder="" />
                <x-input  label="Employer name" placeholder="" />
                <x-input  label="Position" placeholder="" />
                <x-input  label="Salary" placeholder="" />
        </div>
        <x-checkbox id="left-label" left-label="Nominee" wire:model.defer="model" />
        <button
            wire:click="",
            class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400 text-right">
            Delete
        </button>
    </x-card>
</div> --}}

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
            <div class="grid grid-cols-2 gap-4 mt-4">

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
