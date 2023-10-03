<div>
    <x-container title="Dividen Approval" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
        <div>
            <!-- DIVIDEND WITHDRAWAL - APPLICATION -->
            <x-card title="DIVIDEND WITHDRAWAL - APPLICATION">
                <div class="grid grid-cols-1">
                    <div class="flex items-center space-x-2 my-4">
                        <div >
                            <x-input 
                                label="Start Date" 
                                type="date"
                                wire:model=""
                            />
                        </div>
                        <div>
                            <x-input 
                                label="End Date" 
                                type="date"
                                wire:model=""
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
                        <div class="flex items-center space-x-2 my-4">
                            <div >
                                <x-input 
                                    label="Start Date" 
                                    type="date"
                                    wire:model=""
                                />
                            </div>
                            <div>
                                <x-input 
                                    label="End Date" 
                                    type="date"
                                    wire:model=""
                                />
                            </div>
                            <div class="w-64">
                                <x-native-select label="Bank Comapnay"  wire:model="">
                                    <option value=""></option>
                                </x-native-select>
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
    </x-container>
</div>
