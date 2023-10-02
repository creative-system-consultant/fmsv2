<div>
    <x-container title="Member Info" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>

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
                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                        <x-table.table-header class="text-left" value="MEMBERSHIP ID" sort="" />
                        <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="BSKE GOLD(G)" sort="" />
                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                        <x-table.table-header class="text-left" value="APPROVED DATE" sort="" />
                        <x-table.table-header class="text-left" value="UPDATE DATE" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                1
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                2
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                3
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                4
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                5
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                6
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                7
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                8
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                9
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button sm  href="{{ route('cif.info') }}" icon="eye" primary label="View" wire:navigate/>
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
            
        </div>
    </x-container>
</div>

