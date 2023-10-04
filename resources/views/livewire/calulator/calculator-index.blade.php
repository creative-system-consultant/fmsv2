<div>
    <x-container title="Calculator" routeBackBtn="" titleBackBtn="" disableBackBtn="false">
        <div class="grid grid-cols-1">
            <x-card title="Financing Calculator">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <x-input 
                        label="Financing Amount" 
                        wire:model=""
                    />

                    <x-input 
                        label="Profit Rate" 
                        wire:model=""
                    />

                    <x-input 
                        label="Duration (Months)" 
                        wire:model=""
                    />

                    <x-native-select label="Profit Calculation Mode"  wire:model="" >
                        <option value=""></option>
                    </x-native-select>

                    <x-native-select label="Instalment Mode"  wire:model="" >
                        <option value=""></option>
                    </x-native-select>

                    <x-input 
                        label="Grace period (Months)" 
                        wire:model=""
                        disabeled
                    />

                    <div class="mt-6">
                        <x-checkbox 
                            id="right-label" 
                            label="Profit Servicing During Grace period"
                            md 
                            wire:model="" 
                        />
                    </div>

                    <x-input 
                        label="Selling Price" 
                        wire:model=""
                        disabeled
                    />

                    <x-input 
                        label="Total Profit Amount" 
                        wire:model=""
                        disabeled
                    />

                    <x-input 
                        label="Instalment Amount" 
                        wire:model=""
                        disabeled
                    />

                </div>
                <x-slot name="footer">
                    <div class="flex justify-end space-x-2 items-center">
                        <x-button sm label="Cancel"  />
                        <x-button sm label="Calculate" icon="calculator" primary />
                    </div>
                </x-slot>
            </x-card>
        </div>
    </x-container>
</div>
