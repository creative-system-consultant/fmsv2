<div>
    <x-container title="Religions Maintenance" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <div wire:click="openCreateModal" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded cursor-pointer hover:bg-green-400">
                Create
            </div>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="NO." sort="" />
                    <x-table.table-header class="text-left" value="RELIGION NAME" sort="" />
                    <x-table.table-header class="text-left" value="CODE" sort="" />
                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($data as $religion)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $loop->iteration }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $religion->description }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $religion->code }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                @if($religion->status == 1)
                                    <x-badge flat emerald label="ENABLE" />
                                @else
                                    <x-badge flat negative  label="DISABLE" />
                                @endif
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div wire:click="openUpdateModal({{ $religion->id }})" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded cursor-pointer hover:bg-orange-400">
                                    Edit
                                </div>

                                <button
                                    wire:click="delete({{ $religion->id }})",
                                    class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400">
                                    Delete
                                </button>
                            </x-table.table-body>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table.table>
        </div>
        <div class="mt-5">
            {{ $data->links() }}
        </div>
    </x-container>

    <!-- modal -->
    <x-modal.card title="{{ $modalTitle }}" align="center" blur wire:model.defer="openModal" max-width="lg" hide-close="true">
        <div class="grid gap-4 my-2 lg:grid-cols-2 ">
            <x-input wire:model="code" label="Code" placeholder="" class="uppercase "/>
            <x-input wire:model="description" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            <x-toggle wire:model="status" left-label="Status" />
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    <!-- end modal -->
</div>
