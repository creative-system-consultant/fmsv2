<div>
    <div class="grid grid-cols-1 px-4">
        <div class="flex items-center space-x-2">
            <x-label label="Search :"/>
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
                    <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-right" value="APPROVED AMOUNT" sort="" />
                    <x-table.table-header class="text-center" value="APPROVED DATE" sort="" />
                    <x-table.table-header class="text-left" value="CAUSE" sort="" />
                    <x-table.table-header class="text-left" value="PAYMENT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse($apply_list as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                {{ $item->identity_no }}
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->mbr_no }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->name }}
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                {{ $item->approved_amount }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->appoved_date }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-left">
                                {{ $item->descs }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-left">
                                {{ $item->payment }}
                            </x-table.table-body>
                            
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button
                                        xs
                                        icon="cursor-click"
                                        label="select"
                                        green
                                        wire:click="selectSpecialAid({{ $item->apply_id }})"
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                        @empty
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            No Data
                        </x-table.table-body>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

        <div class="mt-6">
            <x-card >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-input 
                        label="Transaction Amount" 
                        wire:model="approved_amount"
                    />

                    <x-input 
                        label="Transaction Date" 
                        type="date"
                        wire:model="txn_date"
                    />

                    <x-input 
                        label="Document No" 
                        wire:model="doc_no"
                        disabled
                    />

                    <x-select label="Bank Customer" placeholder="-- PLEASE SELECT --" wire:model="bankMember">
                        @foreach ($refBank as $bank)
                        <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                        @endforeach
                    </x-select>

                    <x-input 
                        label="Bank Account No" 
                        wire:model="bank_acct_no"
                    />

                    <x-select label="Bank Client" placeholder="-- PLEASE SELECT --" wire:model="bankClient">
                        @foreach ($refBank as $bank)
                        <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                        @endforeach
                    </x-select>
                </div>

                <div class="grid grid-cols-1 gap-4 mt-4">
                    <x-textarea label="Remarks" wire:model="remarks" />
                </div>
                
                <x-slot name="footer">
                    <div class="flex justify-end items-center">
                        <x-button 
                            sm  
                            icon="clipboard-check" 
                            primary 
                            label="Save"
                            wire:click="postTransaction()"
                        />
                    </div>
                </x-slot>
            </x-card>
        </div>
        
    </div>
</div>

