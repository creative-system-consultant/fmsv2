<div>
    <x-container title="Concept Code Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true" >
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
                        <x-label label="Search : " />
                        <x-input
                            type="text"
                            wire:model.live.debounce.1500ms="searchQuery"
                            placeholder="Search"
                            class="uppercase "
                            />
                        <x-label label="List Until : " />
                        <x-input
                            type="number"
                            wire:model.live.debounce.1500ms="paginated"
                            placeholoder="00"
                            min="0"
                        />
                    </div>
                </div>

                <x-table.table loading="true" loadingtarget="paginated">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO." sort="" />
                        <x-table.table-header class="text-left" value="DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="CODE" sort="" />
                        <x-table.table-header class="text-left" value="PRIORITY" sort="" />
                        <x-table.table-header class="text-left" value="CONCEPT" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">

                        @foreach ($data as $key => $conceptCode)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $data->firstItem() + $key }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $conceptCode->description }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $conceptCode->code }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $conceptCode->priority }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $conceptCode->concept }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button
                                        wire:click="openUpdateModal({{ $conceptCode->id }})"
                                        xs
                                        icon="pencil-alt"
                                        orange
                                        label="Edit"
                                    />
                                    <x-button
                                        wire:click="delete({{ $conceptCode->id }},'{{ $conceptCode->description }}')"
                                        xs
                                        icon="trash"
                                        red
                                        label="Delete"
                                    />
                                </x-table.table-body>
                            </tr>
                        @endforeach

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
        <div class="grid gap-4 my-2 lg:grid-cols-2">
            <div class="tooltip buttom" title="Concept Code ID must be numberic and maximum 2 characters">
                <x-input wire:model="code" label="Code" placeholder="" class=""/>
            </div>
            <div class="tooltip buttom" title="Description must be alphabetic">
                <x-input wire:model="description" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            </div>
            <div class="tooltip buttom" title="Concept can be character and number">
                <x-input wire:model="concept" label="Concept" placeholder="" class="uppercase"/>
            </div>
            @if (substr($modalMethod, 0, 6) == "update")
            <div class="tooltip buttom" title="Priority must be number">
                <x-input wire:model="priority" label="Priority" placeholder="" class=""/>
            </div>
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex gap-2">
                    <x-button secondary label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                </div>
            </div>
        </x-slot>

    </x-modal.card>
    <!-- end modal -->
</div>
