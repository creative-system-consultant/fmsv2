<div>
    <div class="grid grid-cols-1">
        <div class="grid grid-cols-12 gap-1">
            <div class="col-span-12 mb-4">
                <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4">
                    <div>
                        <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                            <div class="w-full lg:w-96">
                                <x-select
                                    label="Batch No"
                                    placeholder="-- PLEASE SELECT --"
                                    minItemsForSearch="1"
                                    wire:model.live=""
                                >
                                    <x-select.option label="" value="" />
                                </x-select>
                            </div>
                            <div class="w-full lg:w-64">
                                <x-datetime-picker
                                    label="Transaction Date"
                                    wire:model=""
                                    without-time=true
                                    display-format="DD/MM/YYYY"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4 mt-4">
                    <div>
                        <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                            <div class="w-full lg:w-[11rem]">
                                <x-input 
                                    label="Number of Application"
                                    wire:model="" 
                                    disabled
                                />
                            </div>
                            <div class="w-full lg:w-[11rem]">
                                <x-input 
                                    label="Number of Successful" 
                                    wire:model=""
                                    disabled
                                />
                            </div>
                            <div class="w-full lg:w-[11rem]">
                                <x-inputs.currency
                                    class="!pl-[2.5rem]"
                                    label="Successful Payment"
                                    prefix="RM"
                                    thousands=","
                                    decimal="."
                                    wire:model=""
                                    disabled
                                />
                            </div>
                            <div class="w-full lg:w-[11rem]">
                                <x-input 
                                    label="Number of Unsuccessful" 
                                    wire:model=""
                                    disabled
                                />
                            </div>
                            <div class="w-full lg:w-[11rem]">
                                <x-inputs.currency
                                    class="!pl-[2.5rem]"
                                    label="Unsuccessful Payment"
                                    prefix="RM"
                                    thousands=","
                                    decimal="."
                                    wire:model=""
                                    disabled
                                />
                            </div>
                            <div class="w-full lg:w-[11rem] pt-5">
                                <x-button 
                                    sm  
                                    icon="search" 
                                    primary 
                                    label="submit" 
                                />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-span-12 mt-4">
                <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4 ">
                    <div class="flex items-center space-x-2 mb-4">
                        <x-label label="Search :"/>
                        <div>
                            <x-native-select  wire:model="model">
                                <option value="">Membership No</option>
                                <option value="">Name</option>
                                <option value="">Identity No</option>
                            </x-native-select>
                        </div>
            
                        <div class="w-64">
                            <x-input 
                                wire:model="search"
                                placeholder="Search"
                            />
                        </div>
                    </div>
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="NO" sort="" />
                            <x-table.table-header class="text-left" value="BATCH NO" sort="" />
                            <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                            <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                            <x-table.table-header class="text-left" value="NAME" sort="" />
                            <x-table.table-header class="text-left" value="PAYMENT AMOUNT (RM)" sort="" />
                            <x-table.table-header class="text-center" value="SUCCESFULL PAYMENT" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                    1
                                </x-table.table-body>
                    
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    KOPDIV20231000002
                                </x-table.table-body>
        
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    00151
                                </x-table.table-body>
                            
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    551030105665
                                </x-table.table-body>
        
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    NOORDIN BIN YUSOF
                                </x-table.table-body>
        
                                <x-table.table-body colspan="" class="text-xs text-right font-medium text-gray-700 ">
                                    156.93
                                </x-table.table-body>
        
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                    <div class="flex justify-center">
                                        <x-checkbox 
                                            id="md" 
                                            md 
                                            wire:model.defer="model" 
                                        />
                                    </div>
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                </div>
            </div>
        </div>
    </div>
</div>

