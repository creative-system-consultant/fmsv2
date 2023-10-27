<div>
    <x-report title="List of Dividend Payment" :startDate="true" :endDate="true" :reportDate="false" :result="$result">
        <x-select
        label="List of Batch"
        placeholder="-- PLEASE SELECT --"
        wire:model="batchNo"
        >
        <x-select.option label="ALL" value="1" />
        @foreach ($list_batch_no as $batch_no)
            <x-select.option label="{{ $batch_no->description }}" value="{{ $batch_no->id }}" />
        @endforeach
        </x-select>

        <x-select
        label="Success Payment"
        placeholder="-- PLEASE SELECT --"
        wire:model="flag"
        >
        <x-select.option label="ALL" value="1" />
        @foreach ($flag_payment as $flag)
            <x-select.option label="{{ $flag->description }}" value="{{ $flag->id }}" />
        @endforeach
        </x-select>
    </x-report>
</div>



