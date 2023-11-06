<div>
    <div class="grid grid-cols-1">
        <x-card title="List of Active Account">
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
                        @forelse ($account_active as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $loop->iteration }}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->mbr_no }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{ $item->name }}</p>
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                CASH-i 1/2/3 TANPA PENJAMIN
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                N/A
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->identity_no }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                <p>{{ $item->account_no }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center">
                                <p>{{ $item->description }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($item->instal_amount,2,'.',',') }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($item->bal_outstanding,2,'.',',') }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($item->selling_price,2,'.',',') }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($item->disbursed_amount,2,'.',',') }}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div>
                                    <x-button sm  href="{{ route('finance.finance-account-info',['uuid' => $item->uuid]) }}" icon="eye" primary label="View" wire:navigate/>
                                </div>
                            </x-table.table-body>
                        </tr>
                        @empty
                        <x-table.table-body colspan="9" class="text-xs font-medium text-gray-700 text-right">
                            <p>No data</p>
                        </x-table.table-body>
                        @endforelse
                    </x-slot>
                </x-table.table>
                <div class="px-2 py-2 mt-4">
                    {{ $account_active->links('livewire::pagination-links') }}
                </div>
            </div>
        </x-card>
        
    </div>
</div>
