<div>
    <x-card title="Contribution Information">
        <div class="grid items-center grid-cols-1 gap-2 md:grid-cols-3">
            <x-input label="Total Balance Contribution" wire:model="totalBalContribution" disabled />
            <x-input label="Total Add Contribution" wire:model="totalAddContribution" disabled />
            <x-input label="Total Withdraw Contribution" wire:model="totalWithdrawContribution" disabled />
            <x-input label="Last Payment Amount" wire:model="lastPaymentAmt" disabled />
            <x-input label="Last Payment Date" wire:model="lastPaymentDate" disabled />
            <x-input label="Last Withdraw Amount" wire:model="lastWithdrawAmt" disabled />
            <x-input label="Last Withraw Amount"  wire:model="lastWithdrawAmt" disabled />
            <x-input label="Last Withdraw Date"  wire:model="lastWithdrawDate" disabled/>
            <x-input label="Monthly" wire:model="monthlyContribution" disabled />
            <x-input label="Number of Withdraw" wire:model="numWithdraw" disabled />
            <x-input label="Total of Withdraw" wire:model="totalWithdraw" disabled />

            <div class="mt-6">
                <x-button
                    onclick="$openModal('contribution-histrory-modal')"
                    primary
                    label="Contribution History"
                    sm
                />
            </div>

            <x-modal.card  title="Monthly Contribution History-In Details" align="center"  wire:model.defer="contribution-histrory-modal">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-center" value="AMOUNT" sort="" />
                        <x-table.table-header class="text-center" value="EFFECTIVE DATE" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($changedMonthlyCon as $item)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ number_format(optional($item->prev_amount, 2)) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{date('d/m/Y',strtotime(optional($item->effective_date)))}}</p>
                                </x-table.table-body>
                            </tr>
                        @empty
                            <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                <x-no-data title="No data"/>
                            </x-table.table-body>
                        @endforelse
                    </x-slot>
                </x-table.table>
            </x-modal.card>
        </div>
    </x-card>

    <div class="mt-12" x-data="{tab:0}">
        <div class="mb-4 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-900">
            <div class="flex items-center space-x-4">
                <x-tab.title name="0">
                    <div class="flex items-center text-sm spcae-x-2">
                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                        <h1>Contribution Statements</h1>
                    </div>
                </x-tab.title>
                <x-tab.title name="1">
                    <div class="flex items-center text-sm spcae-x-2">
                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                        <h1>Contribution Out Statements</h1>
                    </div>
                </x-tab.title>
            </div>
        </div>

        <div>
            <div x-show="tab == 0">
                <x-card title="Contribution Statements">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <x-datetime-picker
                                label="Start Date"
                                wire:model.live="startDateContribution"
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                            <x-datetime-picker
                                label="End Date"
                                wire:model.live="endDateContribution"
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
                            <x-table.table-header class="text-left" value="Transaction Description" sort="" />
                            <x-table.table-header class="text-left" value="Remark" sort="" />
                            <x-table.table-header class="text-left " value="Amount" sort="" />
                            <x-table.table-header class="text-left " value="Total Amount" sort="" />
                            <x-table.table-header class="text-left " value="Created By" sort="" />
                            <x-table.table-header class="text-left " value="Created At" sort="" />
                            <x-table.table-header class="text-left " value="Action" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($contributions as $item)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ date('d/m/Y',strtotime($item->transaction_date)) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{$item->description}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{$item->remarks ? $item->remarks : 'N/A'}}</p>
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
                                    <p>{{number_format($item->total_amount,2)}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{$item->created_by ? $item->created_by : 'N/A'}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{$item->created_at ? date('d/m/Y/h:m:s',strtotime($item->created_at)) : 'N/A'}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    @if ($item->transaction_code_id == 4101)
                                        <div class="inline-flex rounded-md sm:pr-0">
                                            {{-- <x-general.button.icon href="" target="_blank" label="Payment Voucher" color="{{auth()->user()->primary_color}}" livewire="">
                                                <x-heroicon-o-document-report class="-ml-0.5 mr-2 h-4 w-4"/>
                                            </x-general.button.icon> --}}
                                        </div>
                                    @endif
                                </x-table.table-body>
                            </tr>
                            @empty
                                <x-table.table-body colspan="5" class="text-xs font-medium text-gray-700 ">
                                    <p>No Data</p>
                                </x-table.table-body>
                            @endforelse
                        </x-slot>
                    </x-table.table>
                </x-card>
            </div>

            <div  x-show="tab == 1">
                <x-card title="Contribution Out Statements">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <x-datetime-picker
                                label="Start Date"
                                wire:model.live="startDateContribution"
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                            <x-datetime-picker
                                label="End Date"
                                wire:model.live="endDateContribution"
                                without-time=true
                                display-format="DD/MM/YYYY"
                            />
                        </div>

                        <div class="mt-5">
                            <x-button sm icon="document-report" green label="Excel"/>
                            <x-button sm icon="document-report" orange label="PDF" />
                        </div>
                    </div>

                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Date" sort="" />
                            <x-table.table-header class="text-left" value="Transaction Description" sort="" />
                            <x-table.table-header class="text-left" value="Remark" sort="" />
                            <x-table.table-header class="text-left " value="Amount" sort="" />
                            <x-table.table-header class="text-left " value="Total Amount" sort="" />
                            <x-table.table-header class="text-left " value="Action" sort="" />
                        </x-slot>

                        <x-slot name="tbody">
                            @forelse ($contributionsOut as $data)
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <p>{{ date('d/m/Y',strtotime($data->transaction_date)) }}</p>
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <p>{{$data->description}}</p>
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <p>{{$data->remarks ? $data->remarks : 'N/A'}}</p>
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <p>
                                            @if($data->dr_cr == 'D')
                                            -
                                            @endif
                                            {{number_format($data->amount,2)}}
                                        </p>
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <p>{{number_format($data->total_amount,2)}}</p>
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    </x-table.table-body>
                                </tr>
                            @empty
                                <x-table.table-body colspan="5" class="text-xs font-medium text-gray-700 ">
                                    <p>No Data</p>
                                </x-table.table-body>
                            @endforelse
                        </x-slot>
                    </x-table.table>
                </x-card>
            </div>
        </div>
    </div>
</div>
