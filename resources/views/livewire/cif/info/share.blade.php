<div>
    <x-card title="Share Information">
        <div class="grid grid-cols-3 gap-2">
            <x-input  label="Total Balance Share" wire:model="totalShare" disabled />
            <x-input  label="Monthly Share" wire:model="monthly" disabled />
            <x-input  label="Number of Share Withdrawal" wire:model="numWithdraw" disabled />
            <x-input  label="Total Purchase Share" wire:model="totalPurchaseShare" disabled />
            <x-input  label="Last Purchase Amount" wire:model="lastPurchaseAmt" disabled />
            <x-input  label="Last Purchase Date" wire:model="lastPurchaseDate" disabled />
            <x-input  label="Total Sell Share" wire:model="totalSellShare" disabled />
            <x-input  label="Last Sell Amount" wire:model="lastSellAmt" disabled />
            <x-input  label="Last Sell Date" wire:model="lastSellDate" disabled />
            <x-input  label="Share Payment Method" wire:model="sharePaymentMethod" disabled />
        </div>
    </x-card>

    <div class="mt-6">
        <x-card title="Share Statements">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <x-datetime-picker
                        label="Start Date"
                        wire:model.live="startDateShare"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />
                    <x-datetime-picker
                        label="End Date"
                        wire:model.live="endDateShare"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />
                </div>

                <div class="mt-5">
                    <x-button sm icon="document-report" green label="Excel" wire:click="generateExcel"/>
                    {{-- <x-button sm icon="document-report" orange label="PDF" /> --}}
                </div>
            </div>

            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Date" sort="" />
                    {{-- <x-table.table-header class="text-left" value="Doc No" sort="" /> --}}
                    <x-table.table-header class="text-left" value="Transaction Description" sort="" />
                    <x-table.table-header class="text-left " value="Remark" sort="" />
                    <x-table.table-header class="text-right " value="Amount" sort="" />
                    <x-table.table-header class="text-right " value="Total Amount" sort="" />
                    <x-table.table-header class="text-left " value="Created By" sort="" />
                    <x-table.table-header class="text-left " value="Created At" sort="" />
                    <x-table.table-header class="text-left " value="Action" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($shares as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ date('d/m/Y',strtotime($item->transaction_date)) }}</p>
                            </x-table.table-body>
                            {{-- <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->doc_no ? $item->doc_no: 'N/A'}} </p>
                            </x-table.table-body> --}}
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->transactionCode->description}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->remarks ? $item->remarks: 'N/A'}} </p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                <p>
                                    @if($item->transactionCode->dr_cr == 'D') - @endif {{number_format($item->amount,2)}}
                                </p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                <p>{{ number_format($item->total_amount, 2) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->created_by ? $item->created_by : 'N/A'}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->created_at ? date('d/m/Y/h:m:s',strtotime($item->created_at)) : 'N/A'}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            </x-table.table-body>
                        </tr>
                    @empty
                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                            <x-no-data title="No data"/>
                        </x-table.table-body>
                    @endforelse
                </x-slot>
            </x-table.table>

            <div class="py-4">
                {{ $shares->links() }}
            </div>
        </x-card>
    </div>
</div>
