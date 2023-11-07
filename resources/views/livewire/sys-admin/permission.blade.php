<div>
    <x-container title="Permissions" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid grid-cols-1">
            <div class="flex items-center">
                <div>
                    <x-button
                        wire:click="add"
                        xs
                        icon="plus-circle"
                        positive
                        label="Create Permission"
                    />
                </div>
            </div>

            <div class="mt-3">
                <x-table.table loading="true" loadingtarget="search">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($permissions as $permission)
                            <tr>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{ strtoupper($permission->name) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <x-button
                                            wire:click="edit('{{ $permission->id }}')"
                                            xs
                                            icon="pencil-alt"
                                            primary
                                            label="Edit"
                                        />
                                        <x-button
                                            wire:click="delete('{{ $permission->id }}')"
                                            xs
                                            icon="trash"
                                            negative
                                            label="Delete"
                                        />
                                    </div>
                                </x-table.table-body>
                            </tr>
                        @empty
                            <x-table.table-body colspan="2" class="font-medium text-center text-gray-900">
                                <p><center>No data</center></p>
                            </x-table.table-body>
                        @endforelse
                    </x-slot>

                </x-table.table>
                <div class="px-2 py-2 mt-4">
                    {{ $permissions->links('livewire::pagination-links') }}
                </div>
            </div>

        </div>

        <!-- modal -->
        <x-modal.card title="{{ $modalTitle }}" align="center" blur wire:model.defer="openModal" max-width="lg" hide-close="true">
            <div class="gap-4 my-2">
                <x-input wire:model="name" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <div class="flex">
                        <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
    </x-container>
</div>
