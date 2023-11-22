<div>
    <x-container title="Dividend Rules Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <x-card title="">
                <div class="flex items-center justify-between w-full mb-4">
                    <div>
                        <x-button 
                            wire:click="openCreateModal"
                            sm  
                            icon="plus" 
                            green 
                            label="Create" 
                        />
                    </div>
                 
                </div>

                <x-table.table loading="true" loadingtarget="paginated">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO." sort="" />
                        <x-table.table-header class="text-left" value="CLIENT ID" sort="" />
                        <x-table.table-header class="text-left" value="MINIMUM SHARE" sort="" />
                        <x-table.table-header class="text-left" value="YEARS" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />

                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($data as $item)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $loop->iteration }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $item->client_id }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $item->min_share }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $item->years }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button 
                                        wire:click="openUpdateModal({{ $item->id }})"
                                        xs  
                                        icon="pencil-alt" 
                                        orange 
                                        label="Edit" 
                                    />
                                    <x-button 
                                        wire:click="delete({{ $item->id }})"
                                        xs  
                                        icon="trash" 
                                        red 
                                        label="Delete" 
                                    />
                                </x-table.table-body>

                               
                            </tr>
                            @empty
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                        <x-no-data title="No data"/>
                                    </x-table.table-body>
                                </tr>
                            @endforelse
                    </x-slot>
                </x-table.table>

                <x-slot name="footer">
                    <div>
                        {{ $data->links('livewire::pagination-links') }}
                    </div>
                </x-slot>

            </x-card>
        </div>
    </x-container>

    <!-- modal -->
    <x-modal.card title="{{ $modalTitle }}" align="center" blur wire:model.defer="openModal" max-width="lg">
        <div class="grid gap-4 my-2 lg:grid-cols-2 ">
            {{-- <x-input wire:model="code" label="Code" placeholder="" class="uppercase "/> --}}
            <x-input wire:model="clientID" label="Client ID" placeholder="" class="uppercase "/>
            <x-input wire:model="minShare" label="Minimum Share" placeholder="" class="uppercase "/>
            <x-input wire:model="years" label="Years" placeholder="" class="uppercase "/>
            {{-- <x-input wire:model="description" label="Flag Dividend" placeholder="" class="uppercase "/> --}}
            {{-- <x-toggle wire:model="status" left-label="Status" /> --}}
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex space-x-2 items-center">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    <!-- end modal -->
</div>

