<div>
    <div class="grid grid-cols-1">
        <livewire:general.customer-search searchMbrNo=true searchMiscAmt=true />

        <div class="grid grid-cols-12 gap-6 py-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                <x-card title="Category">
                    @foreach($categoryList as $index => $category)
                    <x-tab.basic-title name="{{ $index }}" wire:click="selectType('{{ $category['name'] }}', '{{ $category['code'] }}')">
                        <x-icon name="{{ $category['icon'] }}" class="w-6 h-6 mr-2" />
                        {{ strtoupper($category['name']) }}
                    </x-tab.basic-title>
                    @endforeach
                </x-card>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <div>
                    <div>
                        <div wire:loading wire:target="saveTransaction,confirmSaveTransaction">
                            @include('misc.loading')
                        </div>

                        @php
                        $title = strtoupper($selectedType) . ' DETAILS';
                        @endphp

                        <x-card title="{{ $title }}">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="{{ $selectedType == 'cheque' ? ' block' : 'hidden'}}">
                                    <x-datetime-picker label="Cheque Date" wire:model="chequeDate" without-time=true display-format="DD/MM/YYYY" min="{{ $startDate }}" max="{{ $endDate }}" />
                                </div>

                                <div class=" {{ $selectedType == 'cheque' ? ' block' : 'hidden'}}">
                                    <x-select label="Bank Customer" placeholder="-- PLEASE SELECT --" wire:model="bankMember">
                                        @foreach ($refBank as $bank)
                                        <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                                        @endforeach
                                    </x-select>
                                </div>

                                <x-select label="Bank Client" placeholder="-- PLEASE SELECT --" wire:model="bankClient">
                                    @foreach ($refBankIbt as $bankIbt)
                                    <x-select.option label="{{ $bankIbt->description }}" value="{{ $bankIbt->id }}" />
                                    @endforeach
                                </x-select>

                                <x-input label="Document No" wire:model="docNo" />

                                <x-inputs.currency class="!pl-[2.5rem]" label="Amount" prefix="RM" thousands="," decimal="." wire:model="txnAmt" />

                                <x-datetime-picker label="Transaction Date" wire:model="txnDate" without-time=true display-format="DD/MM/YYYY" min="{{ $startDate }}" max="{{ $endDate }}" />
                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-4">
                                <x-textarea label="Remarks" wire:model="remarks" />
                            </div>

                            @if($saveButton)
                            <x-slot name="footer">
                                <div class="flex items-center justify-end">
                                    <x-button sm icon="clipboard-check" primary label="Save" wire:click="saveTransaction" />
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
