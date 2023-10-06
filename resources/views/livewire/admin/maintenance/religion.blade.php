<div>
    <x-container title="Religions Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true">
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
                                    <x-button 
                                        wire:click="openUpdateModal({{ $religion->id }})"
                                        sm  
                                        icon="pencil-alt" 
                                        orange 
                                        label="Edit" 
                                    />
                                    <x-button 
                                        wire:click="delete({{ $religion->id }})"
                                        sm  
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
