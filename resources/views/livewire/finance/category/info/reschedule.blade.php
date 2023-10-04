<div>
    <div class=" grid grid-cols-1">
        <x-card title="Financing Details as at {{now()->format('d/m/Y')}}" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Balance Outstanding (RM)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Principal Outstanding (RM)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Income Outstanding (RM)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Instalment Amount (RM)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Instalment No. (Paid)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Duration (Month)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Month in Arrears" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Balance Duration (Month)" 
                    wire:model=""
                    disabled
                />
            </div>
        </x-card>

        <div class="mt-6">
            <x-card title="Reschedule" >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-input 
                        label="Date of Birth" 
                        wire:model=""
                        disabled
                    />
                    <x-input 
                        label="Maximum Duration Allowed (Month)" 
                        wire:model=""
                        disabled
                    />
                    <x-input 
                        label="Minimum Instalment Amount Allowed (RM)" 
                        wire:model=""
                        disabled
                    />
                    
                    <x-native-select label="Reschedule Mode"  wire:model="" disabled>
                        <option value=""></option>
                    </x-native-select>
                </div>
            </x-card>
        </div>
    </div>
</div>

