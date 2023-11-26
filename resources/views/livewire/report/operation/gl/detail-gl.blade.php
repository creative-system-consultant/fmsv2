<div>
    <x-report title="Detail Gl" :reportDate="true" :result="$result">
        <x-select
            label="Category"
            placeholder="-- PLEASE SELECT --"
            wire:model="gl_desc"
            style="width: 650px;"
        >
            @forelse ($gl_descs as $gl_desc)
                <x-select.option label="{{ $gl_desc['gl_acctg_desc'] }}" value="{{ $gl_desc['gl_acctg_desc']}}" />
            @endforeach
        </x-select>
    </x-report>
</div>