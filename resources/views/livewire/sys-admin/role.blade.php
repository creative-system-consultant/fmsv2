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
                    {{ $roles->links() }}
                </div>
            </div>

        </div>

        <!-- modal -->
        <x-modal.card title="{{ $modalTitle }}" align="start" blur wire:model.defer="openModal" fullscreen="true">
            <div class="px-2">
                <div class="gap-4 my-2">
                    <x-input wire:model="name" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
                </div>

                <div class="mt-10">
                    <div class="pb-4 mb-4 font-semibold border-b dark:border-gray-800">
                        <div class="flex items-center justify-between">
                            <h1>Role Permissions</h1>
                            <div class="flex items-center space-x-2">
                                <x-label label="Search : " />
                                <div class="w-64">
                                    <x-input
                                        wire:model.live="search"
                                        label=""
                                        placeholder="Search Module"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($systems as $system)
                        <div class="mb-6">
                            <div class="flex items-center space-x-2 mb-2 pl-2">
                                <x-checkbox
                                    id=""
                                    wire:model=""
                                    value=""
                                    md
                                />
                                <h1 class="font-medium">
                                    {{ $system->description }}
                                </h1>
                            </div>
                            <div>
                                @foreach ($modules->where('system_id', $system->id) as $module)
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-3 bg-gray-50 dark:bg-gray-900 py-3 border text-primary-600 flex items-center  dark:border-gray-800">
                                            <div
                                                class="flex font-medium items-center pl-2">
                                                    <x-checkbox
                                                        id=""
                                                        wire:model=""
                                                        value=""
                                                        md
                                                    />
                                                <div class="flex space-x-1 items-start px-4 text-xs">
                                                    <x-icon name="collection" class="w-4 h-4"/>
                                                    <h1>{{ $module->description }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-9 border dark:border-gray-900">
                                            <div class="flex flex-wrap gap-4 px-3 py-4">
                                                @foreach ($permissions->where('system_id', $system->id)->where('module_id', $module->id) as $permission)
                                                    <div class="flex items-center space-x-2">
                                                        <x-checkbox
                                                            id="{{ $permission->id }}"
                                                            wire:model="selectedPermission"
                                                            value="{{ $permission->name }}"
                                                            md
                                                        />
                                                        <x-label class="text-xs" label="{{ strtoupper($permission->name) }}"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <div class="flex items-center space-x-2">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
    </x-container>
</div>
