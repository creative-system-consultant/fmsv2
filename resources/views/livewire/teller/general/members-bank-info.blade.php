<x-card title="Members Bank Info">
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-select
            label="Bank Members"
            placeholder="-- PLEASE SELECT --"
            wire:model="bankMember"
        >
            @foreach ($refBank as $bank)
                <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
            @endforeach
        </x-select>

        <x-input
            label="Members Account No"
            wire:model="memberBankAccNo"
        />
    </div>
    <x-slot name="footer">
        <div class="flex items-center justify-end">
            <x-button
                sm
                icon="clipboard-check"
                primary
                label="Update Info"
                wire:click="saveMemberInfo"
            />
        </div>
    </x-slot>
</x-card>