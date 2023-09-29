<div>
    <h1 class="text-base font-semibold md:text-2xl"></h1>
    <x-container title="Religion Edit Information" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="flex mt-1 mb-2 rounded-md gap-3">
            <x-input wire:model="description" label="Religion" placeholder="" class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3"/>
            <x-input wire:model="code" label="Code" placeholder="" />
        </div>
            <x-toggle left-label="Status" wire:model.defer="status" />
        <div>
            <x-button wire:click="cancel" squared label="Cancel" />
            <x-button wire:click="update('{{ $RefReligion->id }}')" squared positive label="Submit" />
        </div>
    
    
    </x-container>
</div>
