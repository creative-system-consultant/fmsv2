<div>
    <x-container title="Edit GL Code" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
           <x-input
                label="Description"
                wire:model="glcode_description"
                placeholder=""
            />

            <x-input
                label="Code"
                wire:model='glcode_code'
                placeholder=""
            />

            <x-toggle left-label="Status" wire:model.defer="glcode_status" />

            <x-button
                wire:click="cancel"
                squared label="Cancel"
            />

            <x-button
                wire:click="update('{{ $glcode->id }}')"
                squared positive label="Confirm"
            />

        </div>
    </x-container>
</div>

