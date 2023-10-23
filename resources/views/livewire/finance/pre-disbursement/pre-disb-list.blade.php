<div>
    <div class="grid grid-cols-1">
        <x-card title="List of Pre-Disbursement">
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
            
            <div class="mt-6">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCTS" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCTS DETAIL" sort="" />
                        <x-table.table-header class="text-right" value="APPROVED LIMIT" sort="" />
                        <x-table.table-header class="text-right" value="INSTALLMENT AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="APPROVED DATE" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                1
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                AFZARINA BT ADULL MANAN
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                10505
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                160000954
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                761106085564
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                PEMBIAYAAN BARANGAN
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                N/A
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700  text-right">
                                16,568.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                345.17
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                13/12/2022
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div>
                                    <x-button sm  href="{{ route('finance.finance-predisbursement-create',['id' => 1]) }}" icon="eye" primary label="View" wire:navigate/>
                                    <x-button sm  icon="x-circle" red label="Cancel" />
                                </div>
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
        
    </div>
</div>
