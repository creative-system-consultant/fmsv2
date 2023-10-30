<div>
    <x-card title="Autopay Listing To Employer">
        <div class="grid items-start grid-cols-3 gap-2">
            <x-select
                label="Month"
                placeholder="-- PLEASE SELECT --"
                wire:model.live="month"
            >
                @foreach ($months as $month)
                    <x-select.option label="{{ $month['label'] }}" value="{{ $month['value'] }}" />
                @endforeach
            </x-select>
            <x-select
                label="Year"
                placeholder="-- PLEASE SELECT --"
                wire:model.live="year"
            >
                @foreach ($years as $year)
                    <x-select.option label="{{ $year }}" value="{{ $year }}" />
                @endforeach
            </x-select>
            <div class="flex mt-7">
                <x-button
                    sm
                    icon="document-report"
                    green
                    label="Excel"
                    wire:click="generateExcel"
                />
            </div>
        </div>
    </x-card>
</div>