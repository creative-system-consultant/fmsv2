<div>
    <div class="w-full p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                <div class="w-full md:w-96">
                    <x-input
                        label="Name :"
                        wire:model="name"
                        disabled
                    />
                </div>

                @if($searchRefNo)
                <div class="w-full md:w-64">
                    <x-input
                        label="Membership No :"
                        wire:model="searchRefNoValue"
                        disabled
                    />
                </div>
                @endif

                @if($searchMthInstallAmt)
                <x-inputs.currency
                    class="!pl-[2.5rem]"
                    label="Monthly Installment Amount"
                    prefix="RM"
                    thousands=","
                    decimal="."
                    wire:model="searchMthInstallAmtValue"
                    disabled
                />
                @endif

                @if($searchInstallAmtArear)
                <x-inputs.currency
                    class="!pl-[2.5rem]"
                    label="Installment Amount in Arrears"
                    prefix="RM"
                    thousands=","
                    decimal="."
                    wire:model="searchInstallAmtArearAmt"
                    disabled
                />
                @endif

                @if($searchTotContribution)
                <x-inputs.currency
                    class="!pl-[2.5rem]"
                    label="Amount"
                    prefix="RM"
                    thousands=","
                    decimal="."
                    wire:model="searchTotContributionAmt"
                    disabled
                />
                @endif

                @if($searchTotShare)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Share"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchTotShareAmt"
                        disabled
                    />
                @endif
            </div>
            <div class="mt-3">
                <x-button
                    onclick="$openModal('search-modal')"
                    sm
                    icon="search"
                    primary
                    label="Search"
                />

                <x-modal.card title="Search Listing" align="center" max-width="6xl" blur wire:model.defer="search-modal">
                    <div class="grid grid-cols-1 sgap-4">
                        <div class="flex items-center mb-4 space-x-2">
                            <x-label label="Search :"/>
                            <div>
                                <x-native-select wire:model="searchBy">
                                    <option value="CIF.CUSTOMERS.name">Name</option>
                                    <option value="CIF.CUSTOMERS.identity_no">Identity No</option>

                                    @if($customQuery == 'financingRepayment')
                                        <option value="FMS.ACCOUNT_MASTERS.account_no">Account No</option>
                                    @else
                                        <option value="FMS.MEMBERSHIP.ref_no">Membership Id</option>
                                        <option value="CIF.CUSTOMERS.staff_no">Staff No</option>
                                    @endif
                                </x-native-select>
                            </div>

                            <div class="w-64">
                                <x-input
                                    wire:model.lazy="search"
                                    placeholder="Search"
                                />
                            </div>
                        </div>

                        <x-table.table>
                            <x-slot name="thead">
                                @foreach($headers as $header)
                                    <x-table.table-header class="text-left" value="{{ $header }}" sort="" />
                                @endforeach
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($customers as $item)
                                    <tr>
                                        @if($customQuery == 'financingRepayment')
                                            @php
                                            $values = [
                                                $item->identity_no,
                                                $item->name,
                                                $item->account_no,
                                                $item->approved_limit,
                                                '-',
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'withdrawShare')
                                            @php
                                            $values = [
                                                $item->ref_no,
                                                $item->name,
                                                number_format($item->total_share,2),
                                                ($item->last_payment_date) ? date('d/m/Y', strtotime($item->last_payment_date)) : '-',
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @else
                                            @php
                                            $values = [
                                                $item->staff_no,
                                                $item->identity_no,
                                                $item->ref_no,
                                                $item->name,
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @endif

                                        @php
                                            $wireClickFunction = '';

                                            if($customQuery == 'financingRepayment') {
                                                $wireClickFunction = 'selectedAccNo(\''.$item->account_no.'\')';
                                            // } elseif($customQuery == 'withdrawShare') {
                                            //     $wireClickFunction = 'selectedUuid(\''.$item->uuid.'\')';
                                            } else {
                                                $wireClickFunction = 'selectedUuid(\''.$item->uuid.'\')';
                                            }
                                        @endphp

                                        @foreach($values as $key => $value)
                                            @if(is_null($value))
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    <x-button
                                                        x-on:click="close"
                                                        sm
                                                        icon="plus"
                                                        primary
                                                        label="Select"
                                                        wire:click="{{ $wireClickFunction }}"
                                                    />
                                                </x-table.table-body>
                                            @else
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    <p>{{ $value }}</p>
                                                </x-table.table-body>
                                            @endif
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <x-table.table-body colspan="{{ count($headers) }}" class="text-xs font-medium text-gray-700 ">
                                            <div class="flex justify-center text-center">
                                                <p>No data</p>
                                            </div>
                                        </x-table.table-body>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-table.table>

                    </div>
                    <div class="mt-4">
                        {{ $customers->links('livewire::pagination-links') }}
                    </div>
                </x-modal.card>
            </div>
        </div>
    </div>
</div>