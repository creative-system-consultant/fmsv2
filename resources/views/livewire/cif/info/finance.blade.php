<div>
    <div class="grid grid-cols-1">
        <x-card title="Financing List">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Account No" sort="" />
                    <x-table.table-header class="text-left" value="Status" sort="" />
                    <x-table.table-header class="text-left" value="Products" sort="" />
                    <x-table.table-header class="text-left " value="Payment Type" sort="" />
                    <x-table.table-header class="text-left " value="Selling Price" sort="" />
                    <x-table.table-header class="text-left " value="Disbursed Amount" sort="" />
                    <x-table.table-header class="text-left " value="Advance Payment Amount" sort="" />
                    <x-table.table-header class="text-left " value="Installment Amount" sort="" />
                    <x-table.table-header class="text-left " value="Disbursed Date" sort="" />
                    <x-table.table-header class="text-left " value="Balance Outstanding" sort="" />

                </x-slot>
                <x-slot name="tbody">
                    @forelse ($accounts as $item)
                    @php
                        $selling_price +=$item->selling_price;
                        $disbursed_amount +=$item->disbursed_amount;
                    @endphp
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->account_no }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->status }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->product }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->payment_type }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            <p>{{ number_format($item->selling_price,2,'.',',') }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            <p>{{ number_format($item->disbursed_amount,2,'.',',') }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            <p>{{ number_format($item->advance_payment,2,'.',',') }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            <p>{{ number_format($item->instal_amount,2,'.',',') }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ date('d-m-Y', strtotime($item->start_disbursed_date)) }}</p>

                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                            <p>{{ number_format($item->bal_outstanding,2,'.',',') }}</p>

                        </x-table.table-body>
                    </tr>
                    @empty @endforelse

                    <tr class="bg-gray-50">
                        <x-table.table-body colspan="4" class="text-xs  text-gray-700 font-bold text-right">
                            Total
                        </x-table.table-body>
                        <x-table.table-body colspan="1" class="text-xs  text-gray-700 font-bold text-right">
                            <p>{{ number_format($selling_price,2,'.',',') }}</p>

                        </x-table.table-body>
                        <x-table.table-body colspan="1" class="text-xs  text-gray-700 font-bold text-right">
                            <p>{{ number_format($disbursed_amount,2,'.',',') }}</p>

                        </x-table.table-body>
                        <x-table.table-body colspan="4" class="text-xs  text-gray-700 font-bold text-right">
                        </x-table.table-body>
                    </tr>
                </x-slot>
            </x-table.table>
        </x-card>
    </div>
</div>
