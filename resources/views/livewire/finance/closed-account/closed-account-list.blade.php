<div>
    <div class="grid grid-cols-1">
        <x-card title="List of Closed Account">
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
                        <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCTS" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCTS DETAIL" sort="" />
                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-right" value="STATUS" sort="" />
                        <x-table.table-header class="text-right" value="INSTALLMENT AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="BALANCE OUTS" sort="" />
                        <x-table.table-header class="text-left" value="SELLING PRICE" sort="" />
                        <x-table.table-header class="text-left" value="DISBURSED AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                1
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                03229
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                ABANG HISYAMUDDIN BIN ABANG RAMLIE
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                CASH-i 1/2/3 TANPA PENJAMIN
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                N/A
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                990217016536
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                78111998036488
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center">
                                ACTIVE
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                848.41
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                24,604.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                32,000.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                20,000.00
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div>
                                    <x-button sm  href="{{ route('finance.finance-account-info',['id' => 1]) }}" icon="eye" primary label="View" wire:navigate/>
                                </div>
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
        
    </div>
</div>
