<div>
    <div class="grid  grid-cols-1">
        <x-card title="Dividend Year : 2022">
            <div class="grid  grid-cols-1 md:grid-cols-2 gap-6">
                <x-card title="Share Bonus">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <x-input 
                            label="Dividen Rate (%)" 
                            wire:model="profit_share_bonus"
                        />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
                        <x-input 
                            label="Numbers of Member" 
                            value="{{ $div_share_bonus->bil_share_bonus }}"
                            wire:model=""
                            disabled
                        />
                        <x-input 
                            label="Total Dividend" 
                            value="{{ number_format($div_share_bonus->total_share_bonus,2) }}"
                            wire:model=""
                            disabled
                        />
                    </div>
                </x-card>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end items-center space-x-2">
                    <x-button 
                        sm 
                        label="Reset"
                    />
                    <x-button 
                        sm 
                        label="calculate" 
                        icon="calculator"  
                        primary 
                    />
                </div>
            </x-slot>
        </x-card>
    </div>
</div>
