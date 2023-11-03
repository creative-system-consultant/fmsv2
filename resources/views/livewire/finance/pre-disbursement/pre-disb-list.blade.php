<div>
    <div class="grid grid-cols-1">
        <x-card title="List of Pre-Disbursement">
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
                        @forelse ($predisb_list as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $loop->iteration }}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->name }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->mbr_no }}</p>
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->account_no }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->identity_no }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                PEMBIAYAAN BARANGAN
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                N/A
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700  text-right">
                                <p>{{ number_format($item->approved_limit,2) }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ number_format($item->instal_amount,2) }}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{ date('d/m/Y', strtotime($item->approved_date)) }}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div>
                                    <x-button sm  href="{{ route('finance.finance-predisbursement-create',['uuid'=>$item->uuid]) }}" icon="eye" primary label="View" wire:navigate/>
                                    <x-button sm  icon="x-circle" red label="Cancel" />
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
                    {{ $predisb_list->links('livewire::pagination-links') }}
                </div>
            </div>
        </x-card>
        
    </div>
</div>
