<div>
    <x-card title="Montly Payment Summary" >
        <div>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="DEDUCTION" sort="" />
                    <x-table.table-header class="text-right" value="AUTOPAY" sort="" />
                    <x-table.table-header class="text-right" value="MONTHLY" sort="" />
                    
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($PaySummary as $item)

                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>Total Monthly Financing Installment</p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                            <p>{{ number_format($item->financing_installment,2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700   text-right">
                            <p>{{ number_format($item->financing_installment,2) }}</p>

                        </x-table.table-body>            
                    </tr>
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500">
                            <p>Total Monthly Deduction</p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right ">
                            <p>{{ number_format($item->monthly_contribution,2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right">
                            <p>{{ number_format($item->monthly_contribution,2) }}</p>

                        </x-table.table-body>            
                    </tr>
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500">
                            <p>Total Monthly Saving</p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right ">
                            <p>{{ number_format($item->monthly_saving,2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right">
                            <p>{{ number_format($item->monthly_saving,2) }}</p>

                        </x-table.table-body>            
                    </tr>
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500">
                            <p>Total Monthly Payable</p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right ">
                            <p>{{ number_format($item->monthly_payble,2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right">
                            <p>{{ number_format($item->monthly_payble,2) }}</p>

                        </x-table.table-body>            
                    </tr>
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500">
                            <p>Total Monthly Third Party</p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right ">
                            <p>{{ number_format($item->monthly_thirdparty,2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right">
                            <p>{{ number_format($item->monthly_thirdparty,2) }}</p>

                        </x-table.table-body>            
                    </tr>
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500">
                            <p>Total Monthly Deduction</p>
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right ">
                            <p class="p-2 text-red-700">{{ number_format($item->financing_installment + $item->monthly_contribution + $item->monthly_saving + $item->monthly_payble + $item->monthly_thirdparty,2) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right">
                            <p class="p-2 text-red-700">{{ number_format($item->financing_installment + $item->monthly_contribution + $item->monthly_saving + $item->monthly_payble + $item->monthly_thirdparty,2) }}</p>

                        </x-table.table-body>            
                    </tr>
                    @empty
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-red-500 text-right">
                                <p>No Data</p>
                            </x-table.table-body>      
                        </tr>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </x-card>
</div>

