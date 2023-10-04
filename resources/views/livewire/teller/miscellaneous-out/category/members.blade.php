<x-card title="Members">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            disabled
        />

        <x-native-select label="Bank Members"  wire:model="">
            <option value=""></option>
        </x-native-select>

        <x-input 
            label="Members Account No" 
            wire:model=""
        />

        <x-native-select label="Bank Company"  wire:model="">
            <option value=""></option>
        </x-native-select>
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
                label="Update Info" 
            />
        </div>
    </x-slot>
</x-card>