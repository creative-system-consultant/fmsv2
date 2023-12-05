<div>
    <x-card title="Dividend Statements" >
        <div class="flex items-center justify-between mb-4">
            <x-input 
                label="Qualified Dividend" 
                placeholder="RM {{ $bal_div !== null  ? number_format($bal_div->bal_dividen,2 ) : '0.00'}}"
                disabled
                wire:model="" 
            />
        
            <div class="flex gap-6">
                <div class="flex items-center space-x-2">
                    <x-datetime-picker
                        label="Start Date"
                        wire:model.live="startDateDividen"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />
                    <x-datetime-picker
                        label="End Date"
                        wire:model.live="endDateDividen"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />

                    <div class="mt-6">
                        <x-button sm icon="document-report" green label="Excel" wire:click="generateExcel"/>
                        {{-- <x-button sm icon="document-report" orange label="PDF" /> --}}
                    </div>
                </div>
            </div>
                
        </div>
        <div>
            <x-table.table>
                
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                    <x-table.table-header class="text-left" value="DOCUMENT NO" sort="" />
                    <x-table.table-header class="text-left" value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="TOTAL AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="REMARKS" sort="" />
                    

                </x-slot>
                <x-slot name="tbody">
                    @forelse ($dividendstmt as $item)

                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->mbr_no }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ date('d/m/Y', strtotime($item->txn_date)) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->description }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->doc_no }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>
                                {{-- @if($item->TxnCode->dr_cr == 'D')
                                -
                                @endif --}}
                                {{number_format($item->txn_amt,2)}}
                            </p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ number_format($item->total_amt, 2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->remarks }}</p>

                        </x-table.table-body>
                    </tr>
                    @empty
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                        <x-no-data title="No data"/>
                    </x-table.table-body>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </x-card>
</div>

