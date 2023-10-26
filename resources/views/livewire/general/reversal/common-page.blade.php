<div>
    <div class="grid grid-cols-1 ">
        <x-card title="Disbursement Reversal">
            <div class="flex items-center space-x-2 ">
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
            
            <div style="margin-top: 30px;">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="Name" sort=""  />
                        <x-table.table-header class="text-left" value="Memebership" sort=""  />
                        <x-table.table-header class="text-left" value="Account No" sort=""  />
                        <x-table.table-header class="text-right" value="Amount" sort=""  />
                        <x-table.table-header class="text-left" value="Description" sort=""  />
                        <x-table.table-header class="text-left" value="Document No" sort=""  />
                        <x-table.table-header class="text-left" value="Remarks" sort=""  />
                        <x-table.table-header class="text-left" value="Transaction Date" sort=""  />
                        <x-table.table-header class="text-left" value="Action" sort=""  />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
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
                        
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button 
                                    sm  
                                    icon="refresh" 
                                    primary 
                                    label="Reverse" 
                                    onclick="$openModal('reversal-modal')"
                                />
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
        
        <livewire:general.reversal.reversal-modal/>
        
    </div>
</div>
