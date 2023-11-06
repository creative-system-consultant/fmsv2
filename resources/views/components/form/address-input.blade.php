<div>
    <div class="grid grid-cols-1 gap-2">
        <x-input 
            label="Address" 
            placeholder="Address 1" 
            wire:model.lazy="addresses.{{ $key }}.address1"
            :disabled=$editable
        />
        <x-input 
            placeholder="Address 2" 
            wire:model.lazy="addresses.{{ $key }}.address2"
            :disabled=$editable
        />
        <x-input 
            placeholder="Address 3" 
            wire:model.lazy="addresses.{{ $key }}.address3"
            :disabled=$editable
        />
    </div>
    <div class="grid grid-cols-1 gap-2 mt-2">
        <x-native-select label="Address Type" wire:model.lazy="addresses.{{ $key }}.address_type_id" name="address_type_id" :disabled=$editable>
            @forelse ($addressTypes as $addressType)
                <option value="{{ $addressType->id }}">{{ $addressType->description }}</option>
            @empty @endforelse
        </x-native-select>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
        <x-input 
            label="Postcode" 
            wire:model.lazy="addresses.{{$key}}.postcode"
            :disabled=$editable
        />
        <x-input 
            label="Town" 
            wire:model.lazy="addresses.{{$key}}.town"
            :disabled=$editable
        />
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2">
        <x-native-select label="State" wire:model.lazy="addresses.{{ $key }}.state_id" name="state_id" :disabled=$editable>
            @forelse ($states as $state)
                <option value="{{ $state->id }}">{{ $state->description }}</option>
            @empty @endforelse
        </x-native-select>

        <x-native-select label="Country" wire:model.lazy="addresses.{{ $key }}.country_id" name="country_id" :disabled=$editable>
            @forelse($countries as $country)
            <option value="{{ $country->id }}">{{ $country->description }}</option>
            @empty @endforelse
        </x-native-select>
    </div>
</div>