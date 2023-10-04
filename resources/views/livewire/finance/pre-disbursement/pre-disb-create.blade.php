<x-container title="PRE DISBURSEMENT" routeBackBtn="{{route('finance.finance-financing-info')}}" titleBackBtn="financig Info list" disableBackBtn="true">
    <div class="grid grid-cols-1">
        <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4">
            <div class="flex items-center justify-between w-full">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                    <div class="w-full md:w-96">
                        <x-input 
                            label="Name :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Membership No :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                </div>
                <div class="w-full md:w-64 mt-4">
                    <x-button 
                        sm  
                        href="#" 
                        icon="clipboard-list" 
                        primary 
                        label="Disbursement Summary" 
                    />
                </div>
            </div>
        </div>

        <div class="mt-6">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="DOCUMENT NAME" sort="" />
                    <x-table.table-header class="text-left" value="EXECUTED DATE" sort="" />
                    <x-table.table-header class="text-left" value="STAMPING DATE" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="flex items-center space-x-2">
                                <x-checkbox id="md" md wire:model="" />
                                <p>Standing Instruction (SI) Date</p>
                            </div>
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="w-52">
                                <x-input wire:model="" type="date" />
                            </div>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div>
                                <div>
                                    <input type="file" id="fileInput" class="hidden w-full" />
                                    <label for="fileInput" class="w-full py-4 cursor-pointer bg-gray-50 border-2 dark:border-gray-700 dark:bg-gray-800 rounded-xl border-dotted border-primary-400 flex items-center justify-center">
                                        <div class="flex  items-center justify-center space-x-2">
                                            <x-icon name="cloud-upload" class="w-4 h-4 text-primary-600 animate-bounce" />
                                            <p class="text-primary-600">Upload your SI document.(PDF format only | Max size 3MB)</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </x-table.table-body>
                    </tr>
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="flex items-center space-x-2">
                                <p>Offer Letter</p>
                            </div>
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="w-52">
                                <x-input wire:model="" type="date" />
                            </div>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            
                        </x-table.table-body>
                    </tr>
                </x-slot>
            </x-table.table>
        </div>
    </div>
</x-container>