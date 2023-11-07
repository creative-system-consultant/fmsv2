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
            </div>
            <div class="mt-4">
                <x-card title="Result">
                    <div class="flex space-x-2 items-center justify-start mb-4">
                        <x-button
                            xs
                            icon="document-report"
                            green
                            label="Laporan Tabung Khairat 2022"
                        />
                        <x-button
                            xs
                            icon="document-report"
                            primary
                            label="Export Excel Monthly Dividend 2022"
                        />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="px-4 py-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <p class="text-sm font-bold text-gray-600 dark:text-white">
                                Overall Total Dividend:
                            </p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg">
                                RM 423,603.25
                            </p>
                        </div>
                        <div class="px-4 py-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <p class="text-sm font-bold text-gray-600 dark:text-white">
                                Total Tabung Khairat Dibayar:
                            </p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg">
                                RM 423,603.25
                            </p>
                        </div>
                        <div class="px-4 py-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <p class="text-sm font-bold text-gray-600 dark:text-white">
                                Outstanding Tabung Khairat:
                            </p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg">
                                RM 423,603.25
                            </p>
                        </div>
                        <div class="px-4 py-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <p class="text-sm font-bold text-gray-600 dark:text-white">
                                Final Overall Total Dividend:
                            </p>
                            <p class="pt-1 text-base font-semibold text-green-500 md:text-lg">
                                RM 423,603.25
                            </p>
                        </div>
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
