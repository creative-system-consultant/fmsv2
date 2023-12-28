<div>
    <div class="grid grid-cols-1 px-4">
        <div class="flex items-center space-x-2">
            <x-label label="Search :"/>
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
                    <x-table.table-header class="text-left" value="DEATH MBRNO" sort="" />
                    <x-table.table-header class="text-left" value="DEATH IC" sort="" />
                    <x-table.table-header class="text-left" value="DEATH NAME" sort="" />
                    <x-table.table-header class="text-left" value="DEATH CAUSE" sort="" />
                    <x-table.table-header class="text-left" value="HEIR MBRNO" sort="" />
                    <x-table.table-header class="text-left" value="HEIR IC" sort="" />
                    <x-table.table-header class="text-left" value="HEIR NAME" sort="" />
                    <x-table.table-header class="text-center" value="APPROVED AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                            11214
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            930920106440
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            ALIA NADZIRAH BINTI MOHD HATTA
                        </x-table.table-body>
                    
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            SAKIT TUA
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            11216
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            880920435110
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            NOR ATIQAH BINTI OMAR
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            6,000.00
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="flex items-center space-x-2">
                                <x-button
                                    xs
                                    icon="cursor-click"
                                    label="select"
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-input 
                        label="Membership No" 
                        wire:model=""
                        disabled
                    />

                    <x-input 
                        label="Amount Waris" 
                        wire:model=""
                    />

                    <x-input 
                        label="Amount Wakaf" 
                        wire:model=""
                    />

                    <x-input 
                        label="Transaction Amount" 
                        wire:model=""
                        disabled
                    />

                    <x-input 
                        label="Transaction Date" 
                        type="date"
                        wire:model=""
                        disabled
                    />

                    <x-input 
                        label="Document No" 
                        wire:model=""
                        disabled
                    />

                    <x-native-select label="Heir Bank"  wire:model="">
                        <option value=""></option>
                    </x-native-select>

                    <x-input 
                        label="Heir Bank Account No" 
                        wire:model=""
                    />

                    <x-input 
                        label="Heir Phone No" 
                        wire:model=""
                    />

                    <x-native-select label="Wakaf Bank"  wire:model="">
                        <option value=""></option>
                    </x-native-select>

                    <x-input 
                        label="Wakaf Bank Account No" 
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

