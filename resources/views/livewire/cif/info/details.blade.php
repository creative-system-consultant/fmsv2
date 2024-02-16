<div>
    <div class="flex items-center justify-end space-x-2">
        <x-button primary label="Close Membership Document" sm />
        <x-button wire:click="editDetail" icon="pencil" primary label="Edit" sm />
        @if($edit)
            <x-button wire:click="saveDetail" icon="save" primary label="Save" sm />
        @endif
    </div>

    <!-- Member's Information -->
    <livewire:cif.info.details.information :uuid="$uuid" />
</div>
