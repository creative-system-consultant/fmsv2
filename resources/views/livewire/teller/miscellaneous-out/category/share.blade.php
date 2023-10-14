<div>
    <x-card title="Share">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
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
            />
        </div>
        <div class="grid grid-cols-1 gap-4 mt-4">
            <x-textarea label="Remarks" wire:model="remarks" />
        </div>
        <x-slot name="footer">
            <div class="flex items-center justify-end">
                <x-button
                    sm
                    icon="clipboard-check"
                    primary
                    label="Pay"
                    wire:click="saveTransaction"
                />
            </div>
        </x-slot>
    </x-card>
</div>