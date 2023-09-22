<div>
    <x-container title="Create Race" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <div class="flex flex-row">
                <x-input
                    label="Race Name"
                    wire:model="race_description"
                    placeholder=""
                />

                <x-input
                    label="Code"
                    wire:model='race_code'
                    placeholder=""
                />

            </div>

            <x-toggle left-label="Status" wire:model.defer="race_status" />

            <x-button
                wire:click="cancel"
                squared label="Cancel"
            />

            <x-button
                wire:click="submit"
                squared positive label="Confirm"
            />

        </div>
    </x-container>
</div>

