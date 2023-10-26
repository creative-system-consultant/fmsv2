<div>
    {{-- @if($loading) --}}
        {{-- <div>
            @include('misc.loading')
        </div> --}}
    {{-- @endif --}}

    <div class="grid grid-cols-1">
        <livewire:general.customer-search
            :searchMbrNo="$searchMbrNo"
            :searchStaffNo="$searchStaffNo"
            :searchAccNo="$searchAccNo"
            :searchTotContribution="$searchTotContribution"
            :searchTotShare="$searchTotShare"
            :searchMthInstallAmt="$searchMthInstallAmt"
            :searchInstallAmtArear="$searchInstallAmtArear"
            :searchBalOutstanding="$searchBalOutstanding"
            :searchRebate="$searchRebate"
            :searchSettleProfit="$searchSettleProfit"
            :searchMiscAmt="$searchMiscAmt"
            :searchFee="$searchFee"
            :searchBalDividen="$searchBalDividen"
            :searchAdvPayment="$searchAdvPayment"
            :searchInstitute="$searchInstitute"
            :searchTrxAmt="$searchTrxAmt"
            :searchModeId="$searchModeId"
            :customQuery="$this->customQuery"
        />

        <div class="grid grid-cols-12 gap-6 py-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            @if($category)
                <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                    <x-card title="Category">
                        @foreach($categoryList as $index => $category)
                            <x-tab.basic-title
                                name="{{ $index }}"
                                wire:click="selectType('{{ $category['name'] }}', '{{ $category['code'] }}')"
                            >
                                <x-icon name="{{ $category['icon'] }}" class="w-6 h-6 mr-2"/>
                                {{ strtoupper($category['name']) }}
                            </x-tab.basic-title>
                        @endforeach
                    </x-card>
                </div>
            @endif

            <div class="col-span-12 {{ $category ? ' lg:col-span-8' : 'lg:col-span-12'}}">
                @if(in_array($module, $tellerOutModule))
                    <div class="mb-4"">
                        <livewire:teller.general.members-bank-info :ic=$ic />
                    </div>
                @endif

                @if ($module == 'miscellaneousOut' && $selectedType == 'financing')
                    <div class="mb-4">
                        <x-card title="FINANCING LIST">
                            <div class="grid grid-cols-1 gap-4 ">
                                <x-table.table>
                                    <x-slot name="thead">
                                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                                        <x-table.table-header class="text-left" value="PRODUCT" sort="" />
                                        <x-table.table-header class="text-left" value="INSTALLMENT" sort="" />
                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        @forelse ($financing as $item)
                                            <tr class="{{ ($selectedMiscOutFinancing == $item->account_no) ? 'bg-primary-200' : '' }}">
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                    <p>{{ $item->account_no }}</p>
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                    <p>{{ $item->product }}</p>
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                    <p>{{ number_format($item->instal_amount, 2) }}</p>
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    @if($selectedMiscOutFinancing != $item->account_no)
                                                        <x-button
                                                            x-on:click="close"
                                                            sm
                                                            icon="plus"
                                                            primary
                                                            label="Select"
                                                            wire:click="miscOutSelectedFinancing('{{ $item->account_no }}')"
                                                        />
                                                    @endif
                                                </x-table.table-body>
                                            </tr>
                                        @empty
                                            <tr>
                                                <x-table.table-body colspan="4" class="text-xs font-medium text-gray-700 ">
                                                    <div class="flex justify-center text-center">
                                                        <p>No data</p>
                                                    </div>
                                                </x-table.table-body>
                                            </tr>
                                        @endforelse
                                    </x-slot>
                                </x-table.table>
                            </div>
                        </x-card>
                    </div>
                @endif

                <div>
                    <div>
                        <div wire:loading wire:target="saveTransaction,confirmSaveTransaction">
                            @include('misc.loading')
                        </div>

                        @php
                            $title = $category ? strtoupper($selectedType) . ' DETAILS' : 'TRANSACTION DETAILS';
                        @endphp

                        <x-card title="{{ $title }}">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="{{ $selectedType == 'cheque' ? ' block' : 'hidden'}}">
                                    <x-datetime-picker
                                        label="Cheque Date"
                                        wire:model="chequeDate"
                                        without-time=true
                                        display-format="DD/MM/YYYY"
                                        min="{{ $startDate }}"
                                        max="{{ $endDate }}"
                                    />
                                </div>

                                @if($category)
                                <div class=" {{ $selectedType == 'cheque' && $module == 'thirdParty' ? ' block' : 'hidden'}}">
                                @endif
                                    @if($module == 'thirdParty')
                                        <x-input label="Cheque No" wire:model="chequeNo" />
                                    @endif
                                @if($category)
                                </div>
                                @endif

                                @if($category)
                                <div class=" {{ $selectedType == 'cheque' ? ' block' : 'hidden'}}">
                                @endif
                                    @if($module != 'withdrawShare')
                                        <x-select
                                            label="Bank Customer"
                                            placeholder="-- PLEASE SELECT --"
                                            wire:model="bankMember"
                                        >
                                            @foreach ($refBank as $bank)
                                                <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                                            @endforeach
                                        </x-select>
                                    @endif
                                @if($category)
                                </div>
                                @endif

                                @if ($module == 'thirdParty' && ($selectedType == 'contribution' || $selectedType == 'misc'))
                                @else
                                    <x-select
                                        label="Bank Client"
                                        placeholder="-- PLEASE SELECT --"
                                        wire:model="bankClient"
                                    >
                                        @foreach ($refBankIbt as $bankIbt)
                                            <x-select.option label="{{ $bankIbt->description }}" value="{{ $bankIbt->id }}" />
                                        @endforeach
                                    </x-select>
                                @endif

                                @if($module == 'withdrawShare' || $module == 'closeMembership')
                                    <x-input label="Document No" wire:model="docNo" disabled />
                                @else
                                    <x-input label="Document No" wire:model="docNo" />
                                @endif

                                @if($additionalField)
                                    <x-input
                                        label="Account No"
                                        wire:model="accNo"
                                        disabled
                                    />
                                @endif

                                <x-inputs.currency
                                    class="!pl-[2.5rem]"
                                    label="Amount"
                                    prefix="RM"
                                    thousands=","
                                    decimal="."
                                    wire:model="txnAmt"
                                />

                                <x-datetime-picker
                                    label="Transaction Date"
                                    wire:model="txnDate"
                                    without-time=true
                                    display-format="DD/MM/YYYY"
                                    min="{{ $startDate }}"
                                    max="{{ $endDate }}"
                                />
                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-4">
                                <x-textarea label="Remarks" wire:model="remarks" />
                            </div>

                            @if($saveButton)
                                <x-slot name="footer">
                                    <div class="flex items-center justify-end">
                                        <x-button
                                            sm
                                            icon="clipboard-check"
                                            primary
                                            label="Save"
                                            wire:click="saveTransaction"
                                        />
                                    </div>
                                </x-slot>
                            @endif
                        </x-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @push('js')
<script>
    Livewire.on('endProcessing', () => {
        @this.set('loading', false);
    });
</script>
@endpush --}}
