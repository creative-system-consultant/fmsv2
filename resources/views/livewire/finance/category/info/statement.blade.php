<div>
    <div class=" grid grid-cols-1"">
        <x-card title="Financing Statements" >
            <x-slot name="action">
                <div>
                    <x-button sm icon="document-report" green label="Excel" wire:click="generateExcel"  sm/>
                    {{-- <x-button sm icon="document-report" orange label="PDF" sm/> --}}
        
                </div>
            </x-slot>
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <x-input type="date"  label="Start Date" value="" wire:model="startDate"/>
                    <x-input type="date"  label="End Date" value="" wire:model="endDate"/>
                </div>
            
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                        <x-table.table-header class="text-left" value="DOC NO" sort="" />
                        <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="REMARKS" sort="" />
                        <x-table.table-header class="text-right" value="AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="BAL OUTS" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL" sort="" />
                        <x-table.table-header class="text-right" value="PROFIT" sort="" />
                        <x-table.table-header class="text-right" value="UEI OUTS" sort="" />
                        <x-table.table-header class="text-right" value="ADV PAYMENT" sort="" />
                        <x-table.table-header class="text-left" value="CREATED BY" sort="" />
                        <x-table.table-header class="text-left" value="CREATED AT" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($statements as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{date('d/m/Y',strtotime($item->transaction_date))}}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->doc_no}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{$item->transaction_code ? $item->transaction_code->description : 'N/A'}}</p>
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->remarks ? $item->remarks : 'N/A'}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->amount}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->stmt_balance}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                <p>{{$item->princp_outs}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->profit}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                <p>{{$item->unearned_outs}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                <p>{{$item->advance_payment}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->created_by}}</p>
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{date('d/m/Y',strtotime($item->created_at))}}</p>
                            </x-table.table-body>
                            @empty
                  
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>No Data</p>
                            </x-table.table-body>
                            
                            @endforelse
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
    </div>
</div>
