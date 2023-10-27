
<div>
    <x-report title="Detail Gl By Account" :startDate="true" :endDate="true" :result="$result">
        <x-select
            label="Account No"
            placeholder="-- PLEASE SELECT --"
            wire:model="gl_code"
            style="width: 600px;" 
        >
        {{-- <x-select.option value="ALL">ALL</x-select.option> --}}
            @foreach ($glc as $gl_code)
                <x-select.option label="{{ $gl_code->GL_CODE}} - {{ $gl_code->DESCRIPTION }}" value="{{ $gl_code->GL_CODE }}" />
            @endforeach
        </x-select>
    </x-report>
</div>