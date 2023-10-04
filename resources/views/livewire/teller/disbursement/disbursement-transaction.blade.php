<div>
    <x-container title="DISBURSEMENT TRANSACTION" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class="flex items-center space-x-2">
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
            
            <div class="mt-6">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO" sort="" />
                        <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                        <x-table.table-header class="text-left" value="IDENTITY NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCTS" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCTS DETAIL" sort="" />
                        <x-table.table-header class="text-center" value="APPROVED AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                1
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                NOR ZAHARA BINTI MOHD ISA
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                700210055198
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                160001411
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                PEMBIAYAAN BARANGAN
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                N/A
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                8,000.00
                            </x-table.table-body>
    
                            
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button 
                                        sm  
                                        icon="plus" 
                                        green 
                                        
                                    />
                                    <x-button 
                                        sm  
                                        icon="x-circle" 
                                        red 
                                        label="cancel" 
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>


            <div class="mt-6">
                <x-card >
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-input 
                            label="Account No" 
                            wire:model=""
                            disabled
                        />
                        <x-input 
                            label="Document No" 
                            wire:model=""
                            disabled
                        />
                        <x-input 
                            label="Amount (RM)" 
                            wire:model=""
                            disabled
                        />
                        <x-input 
                            label="Transaction Date" 
                            type="date"
                            wire:model=""
                        />
                
                        <x-native-select label="Bank"  wire:model="">
                            <option value=""></option>
                        </x-native-select>

                        <x-input 
                            label="Bank Account No" 
                            wire:model=""
                        />

                        <x-native-select label="Bank Company"  wire:model="">
                            <option value=""></option>
                        </x-native-select>
                    </div>
                    
                    <x-slot name="footer">
                        <div class="flex justify-end items-center">
                            <x-button 
                                sm  
                                icon="clipboard-check" 
                                primary 
                                label="Update Info" 
                            />
                        </div>
                    </x-slot>
                </x-card>
            </div>
            
        </div>
    </x-container>
</div>

