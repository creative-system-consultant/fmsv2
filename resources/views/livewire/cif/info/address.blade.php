<div>
    <x-button icon="plus" primary label="Add New" />
    <div class="text-right">
        <x-button icon="pencil" primary label="Edit" />
        <x-button icon="save" primary label="Save" />
    </div>

    <x-card title="Address Detail 1" >
        <div class="grid grid-cols-3 gap-5" style="margin-bottom: 20px">
                <x-input  label="Address" placeholder="" />
                <x-input  label="Address Type" placeholder="" />
                <x-input  label="Postcode" placeholder="" />
                <x-input  label="Town" placeholder="" />
                <x-input  label="State" placeholder="" />
                <x-input  label="Country" placeholder="" />
        </div>
        <x-checkbox id="left-label" left-label="Mailing Address" wire:model.defer="model" />
        <button
            wire:click="",
            class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400 text-right">
            Delete
        </button>
    </x-card>
    
    <x-card title="Address Detail 2" >
            <div class="grid grid-cols-3 gap-5" style="margin-bottom: 20px">
                <x-input  label="Address" placeholder="" />
                <x-input  label="Address Type" placeholder="" />
                <x-input  label="Postcode" placeholder="" />
                <x-input  label="Town" placeholder="" />
                <x-input  label="State" placeholder="" />
                <x-input  label="Country" placeholder="" />
            </div>
        <x-checkbox id="left-label" left-label="Mailing Address" wire:model.defer="model" />
        <button
            wire:click="",
            class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400 text-right">
            Delete
        </button>
    </x-card>
</div>
