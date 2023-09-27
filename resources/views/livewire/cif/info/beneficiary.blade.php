<div>
    <x-button icon="plus" primary label="Add New" />
        <div class="text-right">
            <x-button icon="pencil" primary label="Edit" />
            <x-button icon="save" primary label="Save" />
        </div>
    <x-card title="Beneficiary Information 1" >
            
        <div class="grid grid-cols-3 gap-5" style="margin-bottom: 20px">
                <x-input  label="Name" placeholder="" />
                <x-input  label="Identity Type" placeholder="" />
                <x-input  label="Identity No" placeholder="" />
                <x-input  label="Race" placeholder="" />
                <x-input  label="Religion" placeholder="" />
                <x-input  label="Relation" placeholder="" />
                <x-input  label="Contact No" placeholder="" />
                <x-input  label="Employer name" placeholder="" />
                <x-input  label="Position" placeholder="" />
                <x-input  label="Salary" placeholder="" />
        </div>
        <x-checkbox id="left-label" left-label="Nominee" wire:model.defer="model" />
        <button
            wire:click="",
            class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400 text-right">
            Delete
        </button>
    </x-card>
</div>