<div>
    <div wire:loading wire:target="editAddressbtn,saveAddress">
        @include('misc.loading')
    </div>
    <form wire:submit="saveAddress">
        <div class="flex items-center justify-between mb-5 ">
            <div>
                <x-button icon="plus" primary label="Add New" sm />
            </div>
            <div>
                <x-button icon="pencil" primary label="Edit" sm wire:click="editAddressbtn" />
                <x-button icon="save" primary label="Save" sm type="submit"/>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <! -- Start loop -->
            @forelse ($addresses as $key => $address)
            <x-card title="Address Detail {{ $loop->iteration }}" >
                <x-slot name="action" >
                    <div class="flex items-center space-x-2">
                        <x-checkbox 
                        id="left-label" 
                        left-label="Mailing Address" 
                        wire:model.defer="addresses.{{ $key }}.mail_flag" 
                        wire:loading.attr='readonly' 
                        wire:loading.class="bg-gray-300"
                        />
                        

                        <x-button icon="trash" red label="delete" sm  onclick="deleteAddress({{ $key }})"/>
                    </div>
                </x-slot>
                <div>
                    <div class="grid grid-cols-1 gap-2">
                        <x-input 
                            label="Address" 
                            placeholder="Address 1" 
                            wire:model.defer="addresses.{{ $key }}.address1"
                            :disabled="$editAddress"
                        />
                        <x-input 
                            placeholder="Address 2" 
                            wire:model.lazy="addresses.{{ $key }}.address2"
                            :disabled="$editAddress"
                        />
                        <x-input 
                            placeholder="Address 3" 
                            wire:model.lazy="addresses.{{ $key }}.address3"
                            :disabled="$editAddress"
                        />
                    </div>
                    <div class="grid grid-cols-1 gap-2 mt-2">
                        <x-native-select label="Address Type" wire:model.lazy="addresses.{{ $key }}.address_type_id" name="address_type_id"  :disabled="$editAddress">
                            @forelse ($addressTypes as $addressType)
                                <option value="{{ $addressType->id }}">{{ $addressType->description }}</option>
                            @empty @endforelse
                        </x-native-select>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
                        <x-input 
                            label="Postcode" 
                            wire:model.lazy="addresses.{{$key}}.postcode"
                            :disabled="$editAddress"
                        />
                        <x-input 
                            label="Town" 
                            wire:model.lazy="addresses.{{$key}}.town"
                            :disabled="$editAddress"
                        />
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
                        <x-native-select label="State" wire:model.lazy="addresses.{{ $key }}.state_id" name="state_id"  :disabled="$editAddress">
                            @forelse ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->description }}</option>
                            @empty @endforelse
                        </x-native-select>
                
                        <x-native-select label="Country" wire:model.lazy="addresses.{{ $key }}.country_id" name="country_id"  :disabled="$editAddress">
                            @forelse($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->description }}</option>
                            @empty @endforelse
                        </x-native-select>
                    </div>
                </div>
            </x-card>
            @empty
                <x-no-data title="No data"/>
            @endforelse
            <! -- End loop -->
        </div>
</form>
</div>

