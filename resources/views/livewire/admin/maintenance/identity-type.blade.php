<div>
    <x-container title="Identity Type Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true" >
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
                        <x-table.table-header class="text-left" value="DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="TYPE" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">

                        @foreach ($data as $key => $identitytype)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $data->firstItem() + $key }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $identitytype->description }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $identitytype->type }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button 
                                        wire:click="openUpdateModal({{ $identitytype->id }})"
                                        xs  
                                        icon="pencil-alt" 
                                        orange 
                                        label="Edit" 
                                    />
                                    <x-button 
                                        wire:click="delete({{ $identitytype->id }})"
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
            <div class="tooltip buttom" title="Type must be alphanumeric and maximum 3 characters">
                <x-input wire:model="type" label="Type" placeholder="" class="uppercase" maxlength="3"/>
            </div>
            <div class="tooltip buttom" title="Description must be alphabetic">
                <x-input wire:model="description" label="Description" placeholder="" class="uppercase "/>
            </div> 
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