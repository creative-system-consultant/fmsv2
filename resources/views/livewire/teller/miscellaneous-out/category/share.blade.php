<div>
    <x-card title="Share">
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