<div>
    <x-container title="EARLY SETTLEMENT OVERLAP" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4">
                <div class="flex items-center justify-between">
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
                                label="Fms Account :" 
                                wire:model=""
                                disabled
                            />
                        </div>
                        <div class="w-full md:w-64">
                            <x-input 
                                label="Settelment Amount :" 
                                wire:model=""
                                disabled
                            />
                        </div>
                        <div class="w-full md:w-64">
                            <x-input 
                                label="Principal Amount :" 
                                wire:model=""
                                disabled
                            />
                        </div>
                        <div class="w-full md:w-64">
                            <x-input 
                                label="Profit Amount :" 
                                wire:model=""
                                disabled
                            />
                        </div>
                    </div>
                </div>

                <div class="mt-3 flex justify-end">
                    <x-button 
                        onclick="$openModal('search-modal')"
                        sm  
                        icon="search" 
                        primary 
                        label="Search" 
                    />
                    <x-modal.card title="Search Listing" align="center" max-width="6xl" blur wire:model.defer="search-modal">
                        <div class="grid grid-cols-1 sgap-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <x-label label="Search :"/>
                                <div>
                                    <x-native-select  wire:model="model">
                                        <option value="">Name</option>
                                        <option value="">Identity No</option>
                                        <option value="">Membership Id</option>
                                        <option value="">Staff No</option>
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
                                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                    <x-table.table-header class="text-left" value="NAME" sort="" />
                                    <x-table.table-header class="text-left" value="NEW FMS ACCOUNT" sort="" />
                                    <x-table.table-header class="text-left" value="OVERLAP ACCOUNT" sort="" />
                                    <x-table.table-header class="text-left" value="SETTLEMENT AMOUNT" sort="" />
                                    <x-table.table-header class="text-left" value="PRINCIPAL" sort="" />
                                    <x-table.table-header class="text-left" value="PROFIT" sort="" />
                                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                                </x-slot>
                                <x-slot name="tbody">
                                    <tr>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            
                                        </x-table.table-body>
                
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>
                                    
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                        
                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                        
                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                        
                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                        
                                        </x-table.table-body>
                
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <x-button 
                                                x-on:click="close"
                                                sm  
                                                icon="plus" 
                                                primary 
                                                label="Select" 
                                            />
                                        </x-table.table-body>
                                    </tr>
                                </x-slot>
                            </x-table.table>
                        </div>
                    </x-modal.card>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-4  p-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
                <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                    <x-card title="Category">
                        <x-tab.basic-title name="0">
                            <x-icon name="cash" class="w-6 h-6 mr-2"/>
                            Overlap
                        </x-tab.basic-title>
                    </x-card>
                </div>
                <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                    <x-card title="Overlap Details" >
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <x-input 
                                label="Account No" 
                                wire:model=""
                                disabled
                            />
                            
                            <x-native-select label="Bank Company"  wire:model="">
                                <option value=""></option>
                            </x-native-select>

                            <x-input 
                                label="Document No" 
                                wire:model=""
                            />

                            <x-input 
                                label="Amount" 
                                wire:model=""
                                disabled
                            />

                            <x-input 
                                label="Transaction Date" 
                                type="date"
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
                                    label="Save" 
                                />
                            </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </x-container>
</div>

