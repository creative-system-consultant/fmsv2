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
                                            xs
                                            icon="pencil-alt"
                                            primary
                                            label="Edit"
                                            href="{{ route('roles.edit', ['id' => $role->id ]) }}"
                                            wire:navigate
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
                            <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                <x-no-data title="No data"/>
                            </x-table.table-body>
                        @endforelse
                    </x-slot>
                </x-table.table>
                <div class="px-2 py-2 mt-4">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </x-container>
</div>
