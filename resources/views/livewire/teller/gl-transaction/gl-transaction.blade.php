<div>
    <div class="grid grid-cols-1">
        <div class="bg-blue-100 border-t-4 border-blue-500 rounded-md text-blue-900 px-4 py-3 shadow-md " role="alert">
            <div class="flex items-start space-x-2">
                <div>
                    <x-icon name="information-circle" class="w-6 h-6"/>
                </div>
                <div>
                    <p class="font-bold">Procedure for GL Transaction</p>
                    <ol class="px-4 py-1 text-sm space-y-1">
                        <li>Please run batch first</li>
                        <li>Once the batch is complete, GL Transaction Report can be generated.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="grid grid-cols-2">
            <x-card title="GL Transaction Report">
                <x-slot name="action">
                    <x-button 
                        sm  
                        icon="play" 
                        primary 
                        label="Run Batch" 
                    />
                </x-slot>
                <div class="flex items-center space-x-2">
                    <div class="w-full md:w-96">
                        <x-input 
                            label="Report Date" 
                            type="date"
                            wire:model=""
                        />
                    </div>
                    <div class="mt-6">
                        <x-button 
                            sm  
                            icon="clipboard-check" 
                            green 
                            label="Excel" 
                        />
                    </div>
                </div>
                
            </x-card>
        </div>
    </div>
</div>
