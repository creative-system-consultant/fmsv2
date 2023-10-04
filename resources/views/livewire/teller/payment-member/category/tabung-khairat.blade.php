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
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                    <x-table.table-header class="text-left" value="CAUSES" sort="" />
                    <x-table.table-header class="text-left" value="RELATION" sort="" />
                    <x-table.table-header class="text-center" value="APPROVED AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                            11218
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            ANIZAN BINTI RAMLI
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            791105036346
                        </x-table.table-body>
                    
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            KEMATIAN
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            PASANGAN
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            500.00
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-input 
                        label="Transaction Amount" 
                        wire:model=""
                    />

                    <x-input 
                        label="Transaction Date" 
                        type="date"
                        wire:model=""
                    />

                    <x-input 
                        label="Document No" 
                        wire:model=""
                        disabled
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

