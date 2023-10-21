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

            @if(in_array($module, $tellerOutModule))
                <div class="col-span-12 mb-4">
                    <livewire:teller.general.members-bank-info :ic=$ic />
                </div>
            @endif

            <div class="col-span-12 {{ $category ? ' lg:col-span-8' : 'lg:col-span-12'}}">
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

                            <x-select
                                label="Bank Client"
                                placeholder="-- PLEASE SELECT --"
                                wire:model="bankClient"
                            >
                                @foreach ($refBankIbt as $bankIbt)
                                    <x-select.option label="{{ $bankIbt->description }}" value="{{ $bankIbt->id }}" />
                                @endforeach
                            </x-select>

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

{{-- @push('js')
<script>
    Livewire.on('endProcessing', () => {
        @this.set('loading', false);
    });
</script>
@endpush --}}
