<div>
    <div class="grid  grid-cols-1">
        <x-card title="Dividend Year : 2023">
            <div class="grid  grid-cols-1 md:grid-cols-2 gap-6">
                <x-card title="Share">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <x-input 
                            label="Dividen Rate (%)" 
                            wire:model="profit"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
                        <x-input 
                            label="Numbers of Member" 
                            value="{{ $div_share->bil_share }}"
                            wire:model=""
                            disabled
                        />
                        <x-input 
                            label="Total Dividend Share" 
                            value="{{ number_format($div_share->total_share,2) }}"
                            wire:model=""
                            disabled
                        />
                    </div>
                </x-card>
                <x-card title="Contribution">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <x-input 
                            label="Dividen Rate (%)" 
                            wire:model="profit_cont"
                        />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
                        <x-input 
                            label="Numbers of Member" 
                            value="{{ $div_contribution->bil_con }}"
                            wire:model=""
                            disabled
                        />
                        <x-input 
                            label="Total Dividend Contribution" 
                            value="{{ number_format($div_contribution->total_con,2) }}"
                            wire:model=""
                            disabled
                        />
                    </div>
                   
                </x-card>
                {{-- <x-card title="Result">

                        <div class="px-4 py-6 bg-gray-100 rounded-lg">
                            <p class="text-base font-bold text-gray-600 ">Overall Total Dividend:</p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg"></p>
                        </div>
                        <div class="px-4 py-6 bg-gray-100 rounded-lg">
                            <p class="text-base font-bold text-gray-600 ">Total Tabung Khairat Dibayar:</p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg"></p>
                        </div>
                        <div class="px-4 py-6 bg-gray-100 rounded-lg">
                            <p class="text-base font-bold text-gray-600 ">Outstanding Tabung Khairat:</p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg"></p>
                        </div>
                        <div class="px-4 py-6 bg-gray-100 rounded-lg">
                            <p class="text-base font-bold text-gray-600 ">Final Overall Total Dividend:</p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg"></p>
                        </div>
                </x-card> --}}
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
