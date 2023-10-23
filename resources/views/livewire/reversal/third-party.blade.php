<div>
    <x-container title="THIRD PARTY REVERSAL" routeBackBtn="{{route('reversal.reversal-list')}}" titleBackBtn="reversal list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row">
                <x-label label="Search :"/>
                <div>
                    <x-native-select  wire:model="model">
                        <option value="">Name</option>
                        <option value="">Identity No</option>
                        <option value="">Membership Id</option>
                        <option value="">Staff No</option>
                    </x-native-select>
                </div>

                <div class="w-full sm:w-64">
                    <x-input 
                        wire:model="search"
                        placeholder="Search"
                    />
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="Membership No" sort=""  />
                        <x-table.table-header class="text-left" value="Name" sort=""  />
                        <x-table.table-header class="text-left" value="Transaction Descriptions" sort=""  />
                        <x-table.table-header class="text-left" value="Doc Number" sort=""  />
                        <x-table.table-header class="text-right" value="Amount" sort=""  />
                        <x-table.table-header class="text-left" value="Transaction date" sort=""  />
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
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                            
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            
                            </x-table.table-body>

    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button 
                                    sm  
                                    icon="refresh" 
                                    primary 
                                    label="Reverse" 
                                />
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
            
        </div>
    </x-container>
</div>
