<div>
    <div wire:loading wire:target="saveAdvanceInfo,confirmSaveAdvanceInfo">
        @include('misc.loading')
    </div>
    <x-card title="Members Information">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-select
                label="Bank Members"
                placeholder="-- PLEASE SELECT --"
                wire:model="bank"
            >
                @foreach ($refBank as $bank)
                    <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                @endforeach
            </x-select>
            <x-input
                label="Members Account No"
                wire:model="payableAccountNo"
            />
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-2">
                <x-button
                    sm
                    icon="clipboard-check"
                    primary
                    label="Update Info"
                    wire:click="saveAdvanceInfo"
                />
            </div>
        </x-slot>
    </x-card>
</div>
