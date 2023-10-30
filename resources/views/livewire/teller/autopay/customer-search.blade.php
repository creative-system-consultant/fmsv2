<div>
    <div class="flex flex-col mb-4 space-y-2 sm:items-center sm:space-x-2 sm:flex-row">
        <x-label label="Search :"/>
        <div>
            <x-native-select  wire:model.live="searchBy">
                <option value="CIF.CUSTOMERS.name">Name</option>
                <option value="CIF.CUSTOMERS.identity_no">Identity No</option>
                <option value="FMS.MEMBERSHIP.mbr_no">Membership Id</option>
                <option value="CIF.CUSTOMERS.staff_no">Staff No</option>
            </x-native-select>
        </div>

        <div class="w-full sm:w-64">
            <x-input wire:model.lazy="search" placeholder="Search" />
        </div>
    </div>
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
            <x-table.table-header class="text-left" value="STAFF NO" sort="" />
            <x-table.table-header class="text-left" value="NAME" sort="" />
            <x-table.table-header class="text-left" value="STATUS" sort="" />
            <x-table.table-header class="text-left" value="ACTION" sort="" />
        </x-slot>
        <x-slot name="tbody">
            @forelse ($searchList as $data)
                <tr>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                        <p>{{ $data->identity_no }}</p>
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $data->staff_no }}</p>
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $data->name }}</p>
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $data->description }}</p>
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <div class="flex items-center space-x-2">
                            @if($sub)
                                <x-button
                                    wire:click="selectMember('{{ $data->uuid }}')"
                                    xs
                                    icon="plus"
                                    primary
                                    label="Select Main"
                                />
                                <x-button
                                    wire:click="selectSubMember('{{ $data->uuid }}')"
                                    xs
                                    icon="plus"
                                    primary
                                    label="Select Sub"
                                />
                            @else
                                <x-button
                                    wire:click="selectMember('{{ $data->uuid }}')"
                                    xs
                                    icon="plus"
                                    primary
                                    label="Select"
                                />
                            @endif
                        </div>
                    </x-table.table-body>
                </tr>
            @empty
                <tr>
                    <x-table.table-body colspan="5" class="text-xs font-medium text-center text-gray-700">
                        <p>NO DATA</p>
                    </x-table.table-body>
                </tr>
            @endforelse

        </x-slot>
    </x-table.table>

    <div class="mt-4">
        {{ $searchList->links('livewire::pagination-links') }}
    </div>
</div>
