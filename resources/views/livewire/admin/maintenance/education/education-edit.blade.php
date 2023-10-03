<div>
    <x-container title="Education Edit" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid sm:grid-cols-3 gap-4 items-center ">
            <x-input wire:model="EducationDescription" label="Education" placeholder=""/>
            <x-input wire:model="EducationCode" label="Code" placeholder="" />
            <x-toggle left-label="Status" wire:model.defer="EducationStatus" />
            <div class="flex gap-3">
                <x-button wire:click="cancel" squared label="Cancel"/>
                <x-button wire:click="update({{ $Education->id }})" squared positive label="Update"/>
            </div>
        </div>
    </x-container>
</div>