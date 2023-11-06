<div>
    <x-report title="Member By State" :startDate="true" :endDate="true" :result="$result">
        <x-select
            label="State"
            placeholder="-- PLEASE SELECT --"
            wire:model="state"
        >
            @foreach ($states as $state)
                <x-select.option label="{{ $state->description }}" value="{{ $state->id }}" />
            @endforeach
        </x-select>
    </x-report>
</div>