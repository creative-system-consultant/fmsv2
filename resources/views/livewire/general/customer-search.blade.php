<div>
    <div class="w-full p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
        <div>
            <div class="grid grid-cols-4 gap-4">
                <x-input label="Name" wire:model="name" disabled />

                @if($searchMbrNo)
                    <x-input label="Membership No" wire:model="searchMbrNoValue" disabled />
                @endif

                @if($searchAccNo)
                    <x-input label="Account No" wire:model="searchAccNoValue" disabled />
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
                        label="Total Contribution"
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

                @if($searchBalOutstanding)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Balance Outstanding"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchBalOutstandingAmt"
                        disabled
                    />
                @endif

                @if($searchRebate)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Rebate"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchRebateAmt"
                        disabled
                    />
                @endif

                @if($searchSettleProfit)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Settle Profit"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchSettleProfitAmt"
                        disabled
                    />
                @endif

                @if($searchMiscAmt)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Misc Amount"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchMiscAmtValue"
                        disabled
                    />
                @endif

                @if($searchFee)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Fee"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchFeeValue"
                        disabled
                    />
                @endif

                @if($searchBalDividen)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Dividen"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchBalDividenValue"
                        disabled
                    />
                @endif

                @if($searchAdvPayment)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Total Advance Payment"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchAdvPaymentValue"
                        disabled
                    />
                @endif

                @if($searchInstitute)
                    <x-input
                        label="Institution"
                        wire:model="searchInstituteValue"
                        disabled
                    />
                @endif

                @if($searchTrxAmt)
                    <x-inputs.currency
                        class="!pl-[2.5rem]"
                        label="Recorded Amount"
                        prefix="RM"
                        thousands=","
                        decimal="."
                        wire:model="searchTrxAmtValue"
                        disabled
                    />
                @endif

                @if($searchModeId)
                    <x-input
                        label="Mode Id"
                        wire:model="searchModeIdValue"
                        disabled
                    />
                @endif
            </div>
            <div class="flex justify-end mt-3">
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
                                        <option value="FMS.MEMBERSHIP.mbr_no">Membership Id</option>
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
                                        @if($customQuery == 'financingRepayment' || $customQuery == 'earlySettlementPayment')
                                            @php
                                            $values = [
                                                $item->identity_no,
                                                $item->name,
                                                $item->account_no,
                                                $item->approved_limit,
                                                $item->product,
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'thirdParty')
                                            @php
                                            $mode = '';
                                            $status = '';

                                            if ($item->mode == '1') {
                                                $mode = 'One Of Payment';
                                            } elseif ($item->mode == '2') {
                                                $mode = 'No Expiry';
                                            } elseif ($item->mode == '3') {
                                                $mode = 'Period';
                                            }

                                            if($item->status == '1') {
                                                $status = 'ACTIVE';
                                            } elseif($item->status == '2') {
                                                $status = 'CLOSED';
                                            } elseif($item->status == '3') {
                                                $status = 'FREEZE';
                                            }

                                            $values = [
                                                $item->name,
                                                number_format($item->transaction_amt, 2),
                                                number_format($item->total_contribution, 2),
                                                number_format($item->misc_amt, 2) ?? 0,
                                                $item->description,
                                                $mode,
                                                $status,
                                                date('d-m-Y', strtotime($item->status_effective_dt)) ?? 'N/A',
                                                $item->remarks ?? '',
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'withdrawShare')
                                            @php
                                            $values = [
                                                $item->mbr_no,
                                                $item->name,
                                                number_format($item->total_share,2),
                                                ($item->last_payment_date) ? date('d/m/Y', strtotime($item->last_payment_date)) : '-',
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'closeMembership')
                                            @php
                                            $values = [
                                                $item->mbr_no,
                                                $item->identity_no,
                                                $item->name,
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'miscellaneousOut')
                                            @php
                                            $values = [
                                                $item->mbr_no,
                                                $item->identity_no,
                                                $item->name,
                                                number_format($item->misc_amt, 2),
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'refundAdvance')
                                            @php
                                            $values = [
                                                $item->identity_no,
                                                $item->mbr_no,
                                                $item->name,
                                                $item->account_no,
                                                $item->products,
                                                $item->disbursed_amount,
                                                $item->prin_outstanding,
                                                $item->uei_outstanding,
                                                $item->advance_payment,
                                                $item->bal_outstanding,
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'dividendWithdrawal')
                                            @php
                                            $values = [
                                                $item->mbr_no,
                                                $item->identity_no,
                                                $item->name,
                                                $item->bal_dividen,
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @elseif($customQuery == 'withdrawContribution')
                                            @php
                                            $values = [
                                                $item->mbr_no,
                                                $item->name,
                                                $item->approved_amt ?? 0,
                                                $item->start_approved ?? '-',
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @else
                                            @php
                                            $values = [
                                                $item->staff_no,
                                                $item->identity_no,
                                                $item->mbr_no,
                                                $item->name,
                                                null // placeholder for the button
                                            ];
                                            @endphp
                                        @endif

                                        @php
                                            $wireClickFunction = '';

                                            if($customQuery == 'financingRepayment' || $customQuery == 'refundAdvance') {
                                                $wireClickFunction = 'selectedAccNo(\''.$item->account_no.'\')';
                                            } elseif($customQuery == 'thirdParty') {
                                                $wireClickFunction = 'selectedId(\''.$item->id.'\')';
                                            } elseif($customQuery == 'miscellaneousOut' || $customQuery == 'dividendWithdrawal' || $customQuery == 'withdrawContribution' || $customQuery == 'withdrawShare') {
                                                $wireClickFunction = 'selectedMbr(\''.$item->mbr_no.'\')';
                                            }  else {
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