<div>
    <x-card title="Others Payment">
        <x-slot name="action">
            <div>
                <x-button sm icon="document-report" green label="Excel" sm/>
                <x-button sm icon="document-report" orange label="PDF" sm/>
            </div>
        </x-slot>
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <x-datetime-picker
                    label="Start Date"
                    wire:model.live="startDT"
                    without-time=true
                    display-format="DD/MM/YYYY"
                />
                <x-datetime-picker
                    label="End Date"
                    wire:model.live="endDT"
                    without-time=true
                    display-format="DD/MM/YYYY"
                />
            </div>
        </div>

        <div class="grid grid-cols-1 mt-5">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION" sort="" />
                    <x-table.table-header class="text-left " value="DOCUMENT NO" sort="" />
                    <x-table.table-header class="text-left " value="REMARKS" sort="" />
                    <x-table.table-header class="text-left " value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left " value="CREATED BY" sort="" />
                    <x-table.table-header class="text-left " value="CREATED AT" sort="" />
                    <x-table.table-header class="text-left " value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($othersPayment as $item)
                    <tr>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $item->mbr_no }}</p>
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ date('d/m/Y',strtotime($item->transaction_date)) }}</p>
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $item->description }}</p>
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $item->doc_no }}</p>
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $item->remarks }}</p>
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>
                            @if($item->dr_cr == 'D')
                            -
                            @endif
                            {{number_format($item->amount,2)}}
                        </p>
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
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                        <x-no-data title="No data"/>
                    </x-table.table-body>
                    @endforelse

                </x-slot>
            </x-table.table>
        </div>
    </x-card>
</div>
