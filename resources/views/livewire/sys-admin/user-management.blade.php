<div>
    <x-container title="User Management" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid grid-cols-1">
            <div class="flex items-center">
                {{-- search will be here --}}
            </div>

            <div class="mt-3">
                <x-table.table loading="true" loadingtarget="search">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($users as $user)
                            <tr>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{ strtoupper($user->name) }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <x-button
                                            wire:click="assign('{{ $user->id }}')"
                                            xs
                                            icon="pencil-alt"
                                            primary
                                            label="Assign"
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
                    {{ $users->links('livewire::pagination-links') }}
                </div>
            </div>
        </div>

        <!-- modal -->
        <x-modal.card title="Assign Roles & Permissions" align="center" blur wire:model.defer="openModal" max-width="lg" hide-close="true">
            <div class="gap-4 my-2">
                <x-select
                    label="Role"
                    placeholder="-- PLEASE SELECT --"
                    wire:model="role"
                    multiselect
                >
                    @foreach ($roles as $role)
                        <x-select.option label="{{ strtoupper($role->name) }}" value="{{ $role->name }}" />
                    @endforeach
                </x-select>
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
