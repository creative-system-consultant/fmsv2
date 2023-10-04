<div>
    <x-container title="Transfer Share" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class="flex items-center space-x-2">
                <x-label label="Search :"/>
                <div class="w-64">
                    <x-input 
                        wire:model="search"
                        placeholder="sellerid/buyer id"
                    />
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="ID" sort="" />
                        <x-table.table-header class="text-left" value="SELLER MEMBER ID" sort="" />
                        <x-table.table-header class="text-left" value="SELLER NAME" sort="" />
                        <x-table.table-header class="text-left" value="BUYER MEMBER ID" sort="" />
                        <x-table.table-header class="text-left" value="BUYER NAME" sort="" />
                        <x-table.table-header class="text-left" value="TRANSFER AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="APPROVE DATE" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
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
                                <x-button sm  icon="eye" primary label="View"/>
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
            
        </div>
    </x-container>
</div>

