<div>
    <x-container title="Bank Edit" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid sm:grid-cols-3 gap-4 items-center ">
            <x-input wire:model="BankDescription" label="Bank" placeholder=""/>
            <x-input wire:model="BankCode" label="Code" placeholder="" />
            <x-toggle left-label="Status" wire:model.defer="BankStatus" />
            <div class="flex gap-3">
                <x-button wire:click="cancel" squared label="Cancel"/>
                <x-button wire:click="update({{ $Bank->id }})" squared positive label="Update"/>
            </div>
        </div>
    </x-container>
</div>