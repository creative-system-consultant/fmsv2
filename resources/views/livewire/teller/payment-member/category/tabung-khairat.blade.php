<div>
    <div class="grid grid-cols-1 px-4">
        <div class="flex items-center space-x-2">
            <x-label label="Search:"/>
            <div class="w-64">
                <x-input 
                    wire:model="search"
                    placeholder=""
                />
            </div>
        </div>
        
        <div class="mt-6">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                    <x-table.table-header class="text-left" value="TYPES OF SPECIAL AID" sort="" />
                    <x-table.table-header class="text-left" value="EVENT DATE" sort="" />
                    <x-table.table-header class="text-right" value="APPROVED AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="APPROVED DATE" sort="" />
                    {{-- <x-table.table-header class="text-left" value="PAYMENT" sort="" /> --}}
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse($apply_list as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                {{ $item->mbr_no }}
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->name }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->identity_no }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->descs }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                dd-mm-yyyy {{-- {{ $item->approved_date }} --}}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                {{ $item->approved_amount }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->approved_date }}
                            </x-table.table-body>

                            {{-- <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-left">
                                {{ $item->payment }}
                            </x-table.table-body> --}}
                            
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button
                                        xs
                                        icon="cursor-click"
                                        label="Select"
                                        green
                                        wire:click="selectSpecialAid({{ $item->apply_id }})"
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                        @empty
                        <x-table.table-body colspan="8" class="text-xs font-medium text-gray-700 text-center">
                            No Data
                        </x-table.table-body>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-4 py-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
                <div class="mb-4">
                    <livewire:teller.general.members-bank-info :ic=$ic />
                </div>

                <div>
                    <div>
                        <div wire:loading wire:target=" saveTransaction,confirmSaveTransaction">
                            @include('misc.loading')
                        </div>

                        <x-card title="TRANSACTION DETAILS" >
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-inputs.currency
                                    class="!pl-[2.5rem]" 
                                    label="Amount"
                                    prefix="RM"
                                    thousands=","
                                    decimal="."
                                    wire:model="approved_amount"
                                    disabled
                                />
            
                                <x-datetime-picker 
                                    label="Transaction Date"
                                    without-time=true
                                    placeholder="DD/MM/YYYY"
                                    wire:model="txn_date"
                                />
            
                                <x-input 
                                    label="Document No" 
                                    wire:model="doc_no"
                                    disabled
                                />
            
                                <x-select
                                label="Bank Client"
                                placeholder="-- PLEASE SELECT --"
                                wire:model="bankClient">
                                    @foreach ($refBank as $bank)
                                    <x-select.option
                                    label="{{ $bank->description }}"
                                    value="{{ $bank->id }}" />
                                    @endforeach
                                </x-select>
                            </div>
            
                            <div class="grid grid-cols-1 gap-4 mt-4">
                                <x-textarea
                                label="Remarks"
                                wire:model="remarks" />
                            </div>
                            
                            @if($saveButton)
                            <x-slot name="footer">
                                <div class="flex justify-end items-center">
                                    <x-button 
                                        sm icon="clipboard-check" 
                                        primary label="Save"
                                        wire:click="saveTransaction"
                                    />
                                </div>
                            </x-slot>
                            @endif
                        </x-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

