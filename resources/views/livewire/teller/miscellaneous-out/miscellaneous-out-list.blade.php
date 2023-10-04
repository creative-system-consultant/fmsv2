<div>
    <x-container title="Miscellaneous Out List" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
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
            
            <div style="margin-top: 30px;">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO" sort="" />
                        <x-table.table-header class="text-left" value="MEMBERSHIP ID" sort="" />
                        <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-center" value="MISCELLANEOUS AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="PAY TO" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                1
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                01069
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                650916065344  
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                ROZILAH BINTI IBRAHIM 
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                31,789.24
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button 
                                    href="{{ route('teller.teller-miscellaneous-out-create', ['id' => 1]) }}" 
                                    sm  
                                    icon="eye" 
                                    primary 
                                    label="View" 
                                    wire:navigate
                                />
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
            
        </div>
    </x-container>
</div>

