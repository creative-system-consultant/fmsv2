<div>
    <x-container title="Create Country" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid sm:grid-cols-3 gap-4 items-center ">
            <x-input wire:model="CountryDescription" label="Country" placeholder=""/>
            <x-input wire:model="CountryCode" label="Code" placeholder="" />
            <x-toggle left-label="Status" wire:model.defer="CountryStatus" />
            <div class="flex gap-3">
                <x-button wire:click="cancel" squared label="Cancel"/>
                <x-button wire:click="submit" squared positive label="Create"/>  
            </div>
        </div>
    </x-container>
</div>