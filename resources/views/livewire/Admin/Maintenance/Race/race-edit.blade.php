<div>
    <x-container title="Edit Race" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
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

            <x-toggle left-label="Status" wire:model.defer="race_status" />

            <x-button
                wire:click="cancel"
                squared label="Cancel"
            />

            <x-button
                wire:click="update('{{ $race->id }}')"
                squared positive label="Confirm"
            />

        </div>
    </x-container>
</div>
