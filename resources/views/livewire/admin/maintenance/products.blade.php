<div>
    <x-container title="Products Maintenance" routeBackBtn="{{route('setting.setting-list')}}" titleBackBtn="setting list" disableBackBtn="true">
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
                            placeholder="00"
                            min = '0'
                        />
                    </div>
                </div>

                <x-table.table loading="true" loadingtarget="paginated,searchQuery">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO." sort="" />
                        <x-table.table-header class="text-left" value="PRODUCT NAME" sort="" />
                        <x-table.table-header class="text-left" value="PROFIT RATE" sort="" />
                        <x-table.table-header class="text-left" value="PAYOUT MAX" sort="" />
                        <x-table.table-header class="text-left" value="PROCESS FEE" sort="" />
                        <x-table.table-header class="text-left" value="AMOUNT MIN" sort="" />
                        <x-table.table-header class="text-left" value="AMOUNT MAX" sort="" />
                        <x-table.table-header class="text-left" value="AMOUNT DEFAULT" sort="" />
                        <x-table.table-header class="text-left" value="LAST UPDATED BY" sort="" />
                        <x-table.table-header class="text-left" value="LAST UPDATED AT" sort="" />
                        <x-table.table-header class="text-left" value="PRIORITY" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($data as $key => $products)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $data->firstItem() + $key}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $products->name }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{number_format($products->profit_rate,2)}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{number_format($products->payout_max,2)}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{number_format($products->process_fee,2)}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{number_format($products->amount_min,2)}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{number_format($products->amount_max,2)}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{number_format($products->amount_default,2)}}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $products->updatedBy->name }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $products->updated_at }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    {{ $products->priority }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button
                                        wire:click="openUpdateModal('{{ $products->id }}')"
                                        xs
                                        icon="pencil-alt"
                                        orange
                                        label="Edit"
                                    />
                                    <x-button
                                        wire:click="delete('{{ $products->id }}','{{ $products->name }}')"
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
            <div class="tooltip buttom" title="Description should represent product name(e.g., 'PELANCONGAN')">
                <x-input wire:model="name" label="{{ $modalDescription }}" placeholder="" class="uppercase "/>
            </div>
            <div class="tooltip buttom" title="Profit rate should be a number value (e.g., '4.00')">
                <x-input wire:model="profit_rate" label="Profit Rate" placeholder="" />
            </div>
            <div class="tooltip buttom" title="Maximum value of payout should be a number(e.g., '4.00')">
                <x-input wire:model="payout_max" label="Payout Max" placeholder="" />
            </div>
            <div class="tooltip buttom" title="Process Fee value should be a number (e.g., '4.00')">
                <x-input wire:model="process_fee" label="Process Fee" placeholder="" />
            </div>
            <div class="tooltip buttom" title="Amount min value should be a number (e.g., '4.00')">
                <x-input wire:model="amount_min" label="Amount Min" placeholder="" />
            </div>
            <div class="tooltip buttom" title="Maximum amount should be a number value (e.g., '4.00')">
                <x-input wire:model="amount_max" label="Amount Max" placeholder=""/>
            </div>
            <div class="tooltip buttom" title=" Default amount should be a number value (e.g., '4.00')">
                <x-input wire:model="amount_default" label="Amount Default" placeholder="" />
            </div>
            @if (substr($modalMethod, 0, 6) == "update")
            <div class="tooltip buttom" title="Priority must be number">
                <x-input wire:model="priority" label="Priority" placeholder="" class=""/>
            </div>
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex items-center space-x-2">
                    <x-button secondary label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="{{ $modalMethod }}" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    <!-- end modal -->
</div>