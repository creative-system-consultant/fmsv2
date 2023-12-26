<div>
    <div class="grid grid-cols-1">
        <livewire:general.customer-search searchMbrNo=true searchTotContribution=true customQuery='withdrawContribution' />

        <div class="grid grid-cols-12 gap-6 py-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-12">
                <div class="mb-4"">
                    <livewire:teller.general.members-bank-info :ic=$ic />
                </div>

                <div>
                    <div>
                        <div wire:loading wire:target=" saveTransaction,confirmSaveTransaction">
                    @include('misc.loading')
                </div>

                <x-card title="TRANSACTION DETAILS">
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
