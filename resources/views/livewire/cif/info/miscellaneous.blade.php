<div>
    <div class="grid grid-cols-1">
        <x-card title="Miscellaneous Info" >
            <div class="flex mt-1 mb-2 rounded-md gap-2">
                <x-input wire:model="" label="Total" value="{{ ($miscacc!=null ? number_format($miscacc['misc_amt'],2) : 0) }}" disabled />
                <x-input wire:model="" label="Last Payment Amount" value="{{ ($miscacc!=null ? number_format($miscacc['last_payment_in_amt'],2) : 0) }}" disabled />
                <x-input wire:model="" label="Last Withdrawal Amount" value="{{ ($miscacc!=null ? number_format($miscacc['last_payment_out_amt'],2) : 0)  }}" disabled />
                <x-input wire:model="" label="Last Payment Date" value="{{ isset($miscacc['last_payment_in_dt']) ? date('d/m/Y', strtotime($miscacc['last_payment_in_dt'])) : null }}" disabled />
                <x-input wire:model="" label="Last Withdrawal Date" value="{{ isset($miscacc['last_payment_out_dt']) ? date('d/m/Y', strtotime($miscacc['last_payment_out_dt'])) : null }}" disabled/>
            </div>
        </x-card>

        <div class="mt-6">
            <x-card title="Miscellaneous Statement" >
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <x-datetime-picker
                                label="Start Date"
                                wire:model.live="startDateMisc"
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                            <x-datetime-picker
                                label="End Date"
                                wire:model.live="endDateMisc"
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                        </div>
                    
                        <div class="flex items-center space-x-2">
                            <div class="mt-6">
                                <x-button sm icon="document-report" green label="Excel"/>
                                <x-button sm icon="document-report" orange label="PDF" />
                            </div>
                        </div>
                    </div>
                    
                    <x-table.table style="width:100%">
                        
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                            <x-table.table-header class="text-left" value="TRANSACTION  DATE" sort="" />
                            <x-table.table-header class="text-left" value="DOCUMENT NO" sort="" />
                            <x-table.table-header class="text-left" value="AMOUNT" sort="" />
                            <x-table.table-header class="text-left" value="TOTAL AMOUNT" sort="" />
                            <x-table.table-header class="text-left" value="REMARKS" sort="" />
                            <x-table.table-header class="text-left" value="CREATED BY" sort="" />
                            <x-table.table-header class="text-left" value="CREATED AT" sort="" />
                            <x-table.table-header class="text-left" value="ACTION" sort="" />

                                @php
                                $ctr=0;
                                @endphp
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse($MiscStmt as $item)
                            @if($item->doc_no !=null)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->detail ?  $item->detail->description: 'N/A'}}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{date('d/m/Y',strtotime( $item->transaction_date))}}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->doc_no }}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>
                                        {{number_format($item->transaction_amount,2)}}
                                    </p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{number_format($item->total_amount,2)}}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->remarks }}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{$item->createdby ? $item->createdby: 'N/A'}}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->created_at ?  date('d/m/Yh:m:s', strtotime($item->created_at)) : 'N/A' }}</p>

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                
                                </x-table.table-body>
                            </tr>
                            @elseif ($ctr==0)
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                <x-no-data title="No data"/>
                            </x-table.table-body>
                            @php
                                $ctr=1;
                            @endphp
                            @endif
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
    </div>

</div>


