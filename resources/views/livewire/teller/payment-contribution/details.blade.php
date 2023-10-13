<div>
    <x-card title="{{ strtoupper($type) }} DETAILS" >
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class=" {{ $type == 'cheque' ? 'block' : 'hidden' }}">
                <x-datetime-picker
                    label="Cheque Date"
                    wire:model="chequeDate"
                    without-time=true
                    display-format="DD/MM/YYYY"
                    min="{{ $startDate }}"
                    max="{{ $endDate }}"
                />
            </div>

            <div class=" {{ $type == 'cheque' ? 'block' : 'hidden' }}">
                <x-select
                    label="Bank Customer"
                    placeholder="-- PLEASE SELECT --"
                    wire:model="bankCustomer"
                >
                    @foreach ($refBank as $bank)
                        <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                    @endforeach
                </x-select>
            </div>

            <x-select
                label="Bank Client"
                placeholder="-- PLEASE SELECT --"
                wire:model="bankClient"
            >
                @foreach ($refBankIbt as $bankIbt)
                    <x-select.option label="{{ $bankIbt->description }}" value="{{ $bankIbt->id }}" />
                @endforeach
            </x-select>

            <x-input
                label="Document No"
                wire:model="documentNo"
            />

            <x-inputs.currency
                class="!pl-[2.5rem]"
                label="Amount"
                prefix="RM"
                thousands=","
                decimal="."
                wire:model="transactionAmount"
            />

            <x-datetime-picker
                label="Transaction Date"
                wire:model="transactionDate"
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
