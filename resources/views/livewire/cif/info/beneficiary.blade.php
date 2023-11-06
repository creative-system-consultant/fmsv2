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
        @forelse ($families as $key => $family)
        <x-card title="Beneficiary Information {{ $loop->iteration }}" >
            <x-slot name="action" >
                <div class="flex items-center space-x-2">
                    <x-checkbox 
                        id="left-label" 
                        left-label="Nominee" 
                        wire:model.defer="families.{{ $key }}.nominee_flag" 
                    />
                    <x-button icon="trash" red label="delete" sm />
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-2">
                <x-input 
                    label="Name" 
                    wire:model="families.{{$key}}.name"
                    disabled
                />
            </div>
            <div class="grid grid-cols-2 gap-2 mt-2">

                <x-native-select label="Identity Type" wire:model="families.{{$key}}.identity_type_id" disabled>
                    @foreach ($identity_types as $type)
                                <option value="{{$type->id}}">{{$type->description}}</option>
                                @endforeach
                </x-native-select>

                <x-input 
                    label="Name" 
                    wire:model="families.{{$key}}.identity_no"
                    disabled
                />

                <x-native-select label="Race" wire:model="families.{{$key}}.race_id" disabled>
                    @foreach ($races as $race)
                                <option value="{{$race->id}}">{{$race->description}}</option>
                                @endforeach
                </x-native-select>

                <x-native-select label="Religion" wire:model="families.{{$key}}.religion_id" disabled>
                    @foreach ($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->description}}</option>
                                @endforeach
                </x-native-select>

                <x-native-select label="Relation" wire:model="families.{{$key}}.relation_id" disabled>
                    @foreach ($relations as $relation)
                                <option value="{{$relation->id}}">{{$relation->description}}</option>
                                @endforeach
                </x-native-select>

                <x-input 
                    label="Contact No." 
                    wire:model="families.{{$key}}.phone_no"
                    disabled
                />

                <x-input 
                    label="Employer Name." 
                    wire:model="families.{{$key}}.employer_name"
                    disabled
                />

                <x-input 
                    label="Position." 
                    wire:model="families.{{$key}}.work_post"
                    disabled
                />

                <x-input 
                    label="Salary." 
                    wire:model="families.{{$key}}.salary"
                    disabled
                />

            </div>
        </x-card>
        @endforeach

        <! -- End loop -->
    </div>
</div>
