<div>
    <div class="grid grid-cols-1">
        <!-- DIVIDEND WITHDRAWAL - APPLICATION -->
        <x-card title="DIVIDEND WITHDRAWAL - APPLICATION">
            <div class="grid grid-cols-1">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-end md:space-x-2 md:space-y-0 pb-5 border-b-2 dark:border-gray-800">
                    <div class="w-full lg:w-[11rem]">
                        <x-input 
                            label="Numbers Of Qualified" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full lg:w-[11rem]">
                        <x-inputs.currency
                            class="!pl-[2.5rem]"
                            label="Total Amount Qualified"
                            prefix="RM"
                            thousands=","
                            decimal="."
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full lg:w-[11rem]">
                        <x-input 
                            label="Numbers Of Unclaimed" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full lg:w-[11rem]">
                        <x-inputs.currency
                            class="!pl-[2.5rem]"
                            label="Total Unclaimed"
                            prefix="RM"
                            thousands=","
                            decimal="."
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full lg:w-[11rem]">
                        <x-input 
                            label="Numbers Of Applied" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full lg:w-[11rem]">
                        <x-inputs.currency
                            class="!pl-[2.5rem]"
                            label="Total Amount Applied"
                            prefix="RM"
                            thousands=","
                            decimal="."
                            wire:model=""
                            disabled
                        />
                    </div>
                </div>
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-end md:space-x-2 md:space-y-0 mt-8 mb-4">
                    <div class="flex space-x-2 items-center">
                        <x-label label="Search :"/>
                        <x-native-select  wire:model="model">
                            <option value="">Membership No</option>
                            <option value="">Name</option>
                            <option value="">Identity No</option>
                        </x-native-select>
                    </div>
        
                    <div class="w-full lg:w-64">
                        <x-input 
                            wire:model="search"
                            placeholder="Search"
                        />
                    </div>
                    <div class="w-full lg:w-40">
                        <x-datetime-picker
                            label="Start Date"
                            wire:model=""
                            without-time=true
                            display-format="DD/MM/YYYY"
                        />
                    </div>
                    <div class="w-full lg:w-40">
                        <x-datetime-picker
                            label="End Date"
                            wire:model=""
                            without-time=true
                            display-format="DD/MM/YYYY"
                        />
                    </div>
                </div>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO" sort="" />
                        <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left " value="DIVIDEND AMOUNT (RM)" sort="" />
                        <x-table.table-header class="text-left " value="BANK" sort="" />
                        <x-table.table-header class="text-left " value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left " value="APPLIED DATE" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                        </x-table.table-body>

                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
    
        <!-- DIVIDEND WITHDRAWAL - CSV FILE TO BANK  -->
        <div class="mt-6">
            <x-card title="DIVIDEND WITHDRAWAL - CSV FILE TO BANK">
                <div class="grid grid-cols-1">
                    <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-end md:space-x-2 md:space-y-0 mb-4">
                        <div class="w-full lg:w-40">
                            <x-datetime-picker
                                label="Start Date"
                                wire:model=""
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                        </div>
                        <div class="w-full lg:w-40">
                            <x-datetime-picker
                                label="End Date"
                                wire:model=""
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                        </div>
                        <div class="w-full lg:w-[24rem]">
                            <x-select
                                label="Client Bank"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live=""
                            >
                            <x-select.option label="" value="" />
                        </x-select>
                        </div>
                    </div>
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="NO" sort="" />
                            <x-table.table-header class="text-left" value="BATCH NUMBER" sort="" />
                            <x-table.table-header class="text-left" value="PAYMENT DESCRIPTION" sort="" />
                            <x-table.table-header class="text-left " value="NUMBERS APPLIED" sort="" />
                            <x-table.table-header class="text-left " value="BANK COMPANY" sort="" />
                            <x-table.table-header class="text-left " value="START DATE" sort="" />
                            <x-table.table-header class="text-left " value="END DATE" sort="" />
                            <x-table.table-header class="text-left " value="PAYMENT VOUCHER" sort="" />
                            <x-table.table-header class="text-left " value="ACTION" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button 
                                    sm  
                                    icon="clipboard-list" 
                                    orange 
                                    label="Payment Voucher"
                                />
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button 
                                    sm  
                                    icon="clipboard-list" 
                                    green 
                                    label="Download"
                                />
                            </x-table.table-body>
                        </x-slot>
                    </x-table.table>
                </div>
            </x-card>
        </div>
    </div>
</div>
