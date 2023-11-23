<div>
    <x-container title="Department Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true" >
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
                    <div class="flex items-center space-x-2">
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
                            placeholder="00"
                            min="0" 
                            />           
                    </div>   
                </div>

                <x-table.table loading="true" loadingtarget="paginated,searchQuery">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO." sort="" />
                        <x-table.table-header class="text-left" value="CODE" sort="" />
                        <x-table.table-header class="text-left" value="DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($data as $key => $department)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $data->firstItem() + $key }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $department->dept_kod }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $department->dept_desc }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button 
                                        wire:click="openUpdateModal('{{ $department->id }}')"
                                        sm  
                                        icon="pencil-alt" 
                                        orange 
                                        label="Edit" 
                                    />
                                    <x-button 
                                        wire:click="delete('{{ $department->id }}' , '{{ $department->dept_kod }}')"
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
    <x-modal.card title="{{ $modalTitle }}" align="center" blur wire:model.defer="openModal" max-width="lg">

        <div class="grid gap-4 my-2 lg:grid-cols-2 ">
            <div class="tooltip buttom" title="Input should be a number, limited to 2 digits">
                <x-input wire:model="dept_kod" label="Code " placeholder="" class="uppercase " />
            </div>
            <div class="tooltip buttom" title="Enter the department description (e.g., 'MODAL INSAN')">
                <x-input wire:model="dept_desc" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            </div>
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
