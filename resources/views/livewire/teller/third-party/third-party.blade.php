<div>
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
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-left" value="RECORDED AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="TOTAL CONTRIBUTION" sort="" />
                    <x-table.table-header class="text-left" value="TOTAL MISC" sort="" />
                    <x-table.table-header class="text-left" value="INSTITUTE" sort="" />
                    <x-table.table-header class="text-left" value="MODE" sort="" />
                    <x-table.table-header class="text-center" value="STATUS" sort="" />
                    <x-table.table-header class="text-center" value="EFFECTIVE DATE" sort="" />
                    <x-table.table-header class="text-center" value="REMARKS" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                            AZIZAN BIN OMAR
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            10.00
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            100.56
                        </x-table.table-body>
                    
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            0.00
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            TABUNG TAHFIZ
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            NO EXPIRY
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                            ACTIVE
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                            01-08-2019
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="flex items-center space-x-2">
                                <x-button 
                                    sm  
                                    icon="plus" 
                                    green 
                                    
                                />
                            </div>
                        </x-table.table-body>
                    </tr>
                </x-slot>
            </x-table.table>
        </div>


        <div class="mt-6">
            <x-card >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4 border-b dark:border-b-gray-700">
                    <x-native-select label="Payment Mode"  wire:model="">
                        @foreach($paymentMode as $key => $mode)
                            <option value="{{ $key + 1 }}">{{ $mode }}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <x-input 
                        label="Membership No" 
                        wire:model=""
                        disabled
                    />
                    <x-input 
                        label="Institution" 
                        wire:model=""
                        disabled
                    />
                    <x-input 
                        label="Recorded Amount" 
                        wire:model=""
                        disabled
                    />
                    <x-input 
                        label="Transaction Amount" 
                        wire:model=""
                    />

                    <x-input 
                        label="Cheque No" 
                        wire:model=""
                        :disabled=false
                    />

                    <x-input 
                        label="Cheque Date" 
                        type="date"
                        wire:model=""
                        :disabled=false
                    />

                    <x-input 
                        label="Transaction Date" 
                        type="date"
                        wire:model=""
                        :disabled=false
                    />

                    <x-input 
                        label="Document No" 
                        wire:model=""
                    />

                    <x-native-select label="Bank Company"  wire:model="">
                        <option value=""></option>
                    </x-native-select>
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

