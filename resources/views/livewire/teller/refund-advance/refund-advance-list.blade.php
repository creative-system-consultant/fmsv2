<div>
    <x-container title="REFUND ADVANCE LIST" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
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
                        <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="MEMBERSHIP ID" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCT" sort="" />
                        <x-table.table-header class="text-left" value="DISBURSED AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="PRIN OUTSTANDING" sort="" />
                        <x-table.table-header class="text-left" value="UEI OUTSTANDING" sort="" />
                        <x-table.table-header class="text-left" value="ADV AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="BAL OUTS" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                1
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                720712086638
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                04601
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                ROZILAH BINTI IBRAHIM
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                14604601036743
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                CASH-i 1/2/3
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                200,000.00
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                171,144.65
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                66,198.35
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                3.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                237,343.00
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <x-button 
                                    href="{{ route('teller.teller-refund-advance-create', ['id' => 1]) }}" 
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

