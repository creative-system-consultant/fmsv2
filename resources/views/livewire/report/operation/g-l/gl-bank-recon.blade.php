<div>
    <x-report title="DETAIL GL BY BANK RECON" :reportDate="true" :result="$result">
        <x-select
            label="Bank Recon"
            placeholder="-- PLEASE SELECT --"
            wire:model="bank_koputra"
            style="width: 500px;"
        >
            @foreach ($bank_koputras as $bank_koputra)
                <x-select.option label="{{ $bank_koputra->id }} - {{ $bank_koputra->description }}" value="{{ $bank_koputra->id}}" />
            @endforeach
        </x-select>
    </x-report>
</div>