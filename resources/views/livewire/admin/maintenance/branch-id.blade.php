<div>
    <x-container title="Branch ID Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true" >
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
                            disabled
                        />
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-label label="Order By : " />
                        <select  wire:model.live.debounce.1500ms ="orderBy" 
                            class="rounded-md p-1 border">
                            <option value="default">Default</option>
                            <option value="branch_id">Branch Id</option>
                            <option value="branch_name">Branch Name</option>
                            <option value="priority">Priority</option>
                        </select>
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
                        <x-table.table-header class="text-left" value="BRANCH ID" sort="" />
                        <x-table.table-header class="text-left" value="SYSTEM DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="BRANCH NAME" sort="" />
                        <x-table.table-header class="text-left" value="PRIORITY" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach  ($data as $key => $branchid)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $data->firstItem() + $key }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $branchid->branch_id }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $branchid->sys_desc }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $branchid->branch_name }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $branchid->priority }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button
                                        wire:click="openUpdateModal('{{ $branchid->id }}')"
                                        sm
                                        icon="pencil-alt"
                                        orange
                                        label="Edit"
                                    />
                                    <x-button
                                        wire:click="delete('{{ $branchid->id }}','{{ $branchid->branch_id }}','{{ $branchid->branch_name }}')"
                                        sm
                                        icon="trash"
                                        red
                                        label="Delete"
                                        disabled
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
            <div class="tooltip buttom" title="Input should be a number, limited to 4 digits">
                <x-input wire:model="branch_id" label="Branch ID " placeholder="" class="uppercase " />
            </div>

            <div class="tooltip buttom" title="">
                <x-input wire:model="sys_desc" label="System Description" placeholder="" class="uppercase " disabled/>
            </div>

            <div class="tooltip buttom" title="Enter the name and location of the branch (e.g., 'AMPANG')">
                <x-input wire:model="branch_name" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
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
