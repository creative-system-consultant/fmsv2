<div>
    <div class="flex items-center justify-between mb-5 ">
        <div>
            <x-button icon="plus" primary label="Add New" sm />
        </div>
        <div>
            <x-button icon="pencil" primary label="Edit" sm />
            <x-button icon="save" primary label="Save" sm/>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <! -- Start loop -->
        @foreach ($addresses as $key => $address)
        <x-card title="Address Detail {{ $loop->iteration }}" >
            <x-slot name="action" >
                <div class="flex items-center space-x-2">
                    <x-checkbox 
                        id="left-label" 
                        left-label="Mailing Address" 
                        wire:model.defer="" 
                    />
                    <x-button icon="trash" red label="delete" sm  onclick="deleteAddress({{ $key }})"/>
                </div>
            </x-slot>
            <x-form.address-input
            :key="$key"
            editable={{$editAddress}}
            postcodes=""
            :states="$states"
            :countries="$countries"
            :addressTypes="$addressTypes"
            />
        </x-card>
        @endforeach
        <! -- End loop -->
    </div>
</div>
