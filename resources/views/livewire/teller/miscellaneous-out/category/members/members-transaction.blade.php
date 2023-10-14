<x-card title="Members Transaction">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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

        <x-input
            label="Document No"
            wire:model="docNo"
            disabled
        />

        <x-select
                label="Bank Client"
                placeholder="-- PLEASE SELECT --"
                wire:model="bankClient"
            >
                @foreach ($refBankIbt as $bankIbt)
                    <x-select.option label="{{ $bankIbt->description }}" value="{{ $bankIbt->id }}" />
                @endforeach
            </x-select>
    </div>
    <div class="grid grid-cols-1 gap-4 mt-4">
        <x-textarea label="Remarks" wire:model="remarks" />
    </div>

    @if($membersBankDetails)
        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-2">
                <x-button
                    sm
                    icon="clipboard-check"
                    emerald
                    label="Pay"
                    wire:click="saveTransaction"
                />
            </div>
        </x-slot>
    @endif
</x-card>