<div>
    <x-container title="Roles" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid grid-cols-1">
            <div class="flex items-center">
                <div>
                    <x-button
                        wire:click="add"
                        xs
                        icon="plus-circle"
                        positive
                        label="Create Role"
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
                        @forelse ($roles as $role)
                            <tr>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{ strtoupper($role->name) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <x-button
                                            wire:click="edit('{{ $role->id }}')"
                                            xs
                                            icon="pencil-alt"
                                            primary
                                            label="Edit"
                                        />
                                        <x-button
                                            wire:click="delete('{{ $role->id }}')"
                                            xs
                                            icon="trash"
                                            negative
                                            label="Delete"
                                        />
                                    </div>
                                </x-table.table-body>
                            </tr>
                        @empty
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                <x-no-data title="No data"/>
                            </x-table.table-body>
                        @endforelse
                    </x-slot>

                </x-table.table>
                <div class="px-2 py-2 mt-4">
                    {{ $roles->links('livewire::pagination-links') }}
                </div>
            </div>

        </div>

        <!-- modal -->
        <x-modal.card title="{{ $modalTitle }}" align="center" blur wire:model.defer="openModal" max-width="6xl" hide-close="true">
            <div class="px-2">
                <div class="gap-4 my-2">
                    <x-input wire:model="name" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
                </div>

                <div class="mt-6">
                    <h2 class=" font-semibold border-b pb-1 mb-4 dark:border-gray-800">
                        Role Permissions
                    </h2>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        @foreach ($permissions as $permission)
                            <x-checkbox
                                id="{{ $permission->id }}"
                                label="{{ strtoupper($permission->name) }}"
                                wire:model="selectedPermission"
                                value="{{ $permission->name }}"
                                md
                            />
                        @endforeach
                    </div>
                </div>
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
