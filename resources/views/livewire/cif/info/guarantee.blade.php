<div>
    <!-- GUARANTEE -->
    <x-card title="Guarantee">
        <div class="grid grid-cols-1 gap-x-2 gap-y-0 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left"  value="BORROWER`S MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left"  value="BORROWER`S NAME" sort="" />
                    <x-table.table-header class="text-left " value="ACCOUNT NO" sort="" />
                    <x-table.table-header class="text-left"  value="FINANCING" sort="" />
                    <x-table.table-header class="text-left " value="INSTALL AMOUNT" sort="" />
                    <x-table.table-header class="text-left " value="TOTAL OUSTANDING" sort="" />
                    <x-table.table-header class="text-left " value="FINANCING STATUS" sort="" />
                    <x-table.table-header class="text-left " value="GUARANTOR STATUS" sort="" />
                    <x-table.table-header class="text-left " value="EXPIRED DATE" sort="" />
                    <x-table.table-header class="text-left " value="EFFECTIVE DATE" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($Guarantee as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->mbr_id }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->name }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->account_no }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->product }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ number_format($item->instal_amount,2) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ number_format($item->bal_outstanding,2) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->account_status }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->guarantor_status }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ date('d/m/Y', strtotime($item->expiry_date)) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ date('d/m/Y', strtotime($item->status_effective_date)) }}</p>
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

    <!-- GUARANTOR  -->
    <div class="mt-6">
        <x-card title="Guarantor">
            <div class="grid grid-cols-1 gap-x-2 gap-y-0 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 mt-5">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left " value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left " value="MEMBERSHIP NO" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="FINANCING" sort="" />
                        <x-table.table-header class="text-left " value="BALANCE OUSTANDING" sort="" />
                        <x-table.table-header class="text-left " value="FINANCING STATUS" sort="" />
                        <x-table.table-header class="text-left " value="EFFECTIVE DATE" sort="" />
                        <x-table.table-header class="text-left " value="GUARANTOR STATUS" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($Guarantor as $item)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->account_no }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{$item->guarantor_mbr_id ? $item->guarantor_mbr_id : 'N/A'}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->name }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->product }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ number_format($item->bal_outstanding,2) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->account_status }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ date('d/m/Y', strtotime($item->status_effective_date)) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->guarantor_status }}</p>
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
</div>
