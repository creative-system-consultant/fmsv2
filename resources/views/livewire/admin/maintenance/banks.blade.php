<div>
    <x-container title="Bank Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true">
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
                        <x-label label="Order By : " />
                        <select  wire:model.live.debounce.1500ms ="orderBy" 
                            class="rounded-md p-1 border">
                            <option value="default">Default</option>
                            <option value="code">Code</option>
                            <option value="description">Description</option>
                            <option value="priority">Priority</option>
                            <option value="status">Status</option>
                            <option value="bank_client">Bank Client</option>
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
                            min='0'
                        />          
                    </div>
                </div>

                <x-table.table loading="true" loadingtarget="paginated,searchQuery, orderBy">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO." sort="" />
                        <x-table.table-header class="text-left" value="CODE" sort="" />
                        <x-table.table-header class="text-left" value="DESCRIPTION" sort="" />
                        <x-table.table-header class="text-left" value="BANK LENGTH" sort="" />
                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                        <x-table.table-header class="text-left" value="BANK CLIENT" sort="" />
                        <x-table.table-header class="text-left" value="PRIORITY" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>

                    <x-slot name="tbody">
                        @foreach ($data as $key => $bank)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $data->firstItem() + $key }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $bank->code }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $bank->description }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $bank->bank_acc_len }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    @if($bank->status == 1)
                                        <x-badge flat emerald label="ENABLE" />
                                    @else
                                        <x-badge flat negative  label="DISABLE" />
                                    @endif
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    @if($bank->bank_client == 'Y')
                                        <x-badge flat emerald label="OPEN" />
                                    @else
                                        <x-badge flat negative  label="CLOSE" />
                                    @endif
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $bank->priority }}
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button 
                                        wire:click="openUpdateModal('{{ $bank->id }}')"
                                        xs  
                                        icon="pencil-alt" 
                                        orange 
                                        label="Edit" 
                                    />
                                    <x-button 
                                        wire:click="delete('{{ $bank->id }}','{{ $bank->description }}')"
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
        <div class="grid gap-4 my-2 lg:grid-cols-2 ">
            <div class="tooltip buttom" title="Input should be a number, limited to 2 digits">
                <x-input wire:model="code" label="Code " placeholder="" class="uppercase " />
            </div>

            <div class="tooltip buttom" title="Description should represent bank name(e.g., 'RHB BANK')">
                <x-input wire:model="description" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            </div>

            <div class="tooltip buttom" title="Description should represent bank name(e.g., 'RHB BANK')">
                <x-input wire:model="bank_acc_len" label="Bank Account Length" placeholder="" class="uppercase "/>
            </div>

            @if ($modalMethod == "update($bank_code)")
            <div class="tooltip buttom" title="Priority must be number">
                <x-input wire:model="priority" label="Priority" placeholder="" class=" "/>
            </div>
            @endif 

            <div  class="flex items-center space-x-2">
                <x-toggle md wire:model.defer="status" left-label="Status" />
                <x-toggle md wire:model.defer="bank_client" left-label="Bank Client" />
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex space-x-2 items-center">
                    <x-button secondary label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    <!-- end modal -->
    
</div>