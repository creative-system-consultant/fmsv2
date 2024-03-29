<div>
    <x-container title="Gl Code Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true">
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
                    <div  class="flex items-center space-x-2">
                        <x-label label="List Until : " />
                        <x-input
                            type="number"
                            wire:model.live.debounce.1500ms="paginated"
                            placeholder="00"
                        />
                    </div>
                </div>

                <x-table.table loading="true" loadingtarget="paginated">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO." sort="" />
                        <x-table.table-header class="text-left" value="GL CODE NAME" sort="" />
                        <x-table.table-header class="text-left" value="CODE" sort="" />
                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($data as $glcode)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $loop->iteration }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $glcode->DESCRIPTION }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $glcode->GL_CODE }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    @if($glcode->status == 1)
                                        <x-badge flat emerald label="ENABLE" />
                                    @else
                                        <x-badge flat negative  label="DISABLE" />
                                    @endif
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button
                                        wire:click="openUpdateModal({{ $glcode->id }})"
                                        xs
                                        icon="pencil-alt"
                                        orange
                                        label="Edit"
                                    />
                                    <x-button
                                        wire:click="delete({{ $glcode->id }})"
                                        xs
                                        icon="trash"
                                        red
                                        label="Delete"
                                    />
                                </x-table.table-body>
                            </tr>
                            @empty
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
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
            <x-input wire:model="code" label="Code" placeholder="" class="uppercase "/>
            <x-input wire:model="description" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            <x-toggle wire:model="status" left-label="Status" />
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
    <!-- end modal -->
</div>
