<div>
    <div class=" grid grid-cols-1">
        <x-card title="Repayment Schedule" >
            <x-slot name="action">
                <div>
                    <x-button sm icon="document-report" green label="Excel" sm/>
                    <x-button sm icon="document-report" orange label="PDF" sm/>
                </div>
            </x-slot>
            <div>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="INSTALMENT NO." sort="" />
                        <x-table.table-header class="text-right" value="AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="DATE" sort="" />
                        <x-table.table-header class="text-right" value="BALANCE OUTS" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL OUTS" sort="" />
                        <x-table.table-header class="text-right" value="PROFIT" sort="" />
                        <x-table.table-header class="text-right" value="UEI OUTS" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                    @forelse ($schedules as $item)

                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->instalment_no}}</p>
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->instal_amt}}</p>

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{ date('d/m/Y',strtotime($item->instal_date))}}</p>

                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->bal_outstanding}}</p>

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->print_amt}}</p>

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->prin_outstanding}}</p>

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                <p>{{$item->profit_amt}}</p>

                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>{{$item->uei_outstanding}}</p>

                            </x-table.table-body>
                        </tr>
                        @empty
                        <x-table.table-body colspan="8" class="text-xs font-medium text-gray-700 text-right">
                            <p>No Data</p>
                        </x-table.table-body>
                    @endforelse
                    </x-slot>
                </x-table.table>
            </div>
        </x-card>
    </div>
</div>
