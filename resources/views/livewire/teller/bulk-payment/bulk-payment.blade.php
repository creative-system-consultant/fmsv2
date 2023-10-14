<div>
    <div class="grid grid-cols-1">
        <div class="w-full p-4 bg-white border rounded-lg shadow-md  dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                    <div class="w-full md:w-96">
                        <x-input
                            label="Name :"
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input
                            label="Membership No :"
                            wire:model=""
                            disabled
                        />
                    </div>
                </div>

                <div class="mt-3">
                    <x-button
                        onclick="$openModal('search-modal')"
                        sm
                        icon="search"
                        primary
                        label="Search"
                    />
                    <x-modal.card title="Search Listing" align="center" max-width="6xl" blur wire:model.defer="search-modal">
                        <div class="grid grid-cols-1 sgap-4">
                            <div class="flex items-center mb-4 space-x-2">
                                <x-label label="Search :"/>
                                <div>
                                    <x-native-select  wire:model="model">
                                        <option value="">Name</option>
                                        <option value="">Identity No</option>
                                        <option value="">Membership Id</option>
                                        <option value="">Staff No</option>
                                    </x-native-select>
                                </div>

                                <div class="w-64">
                                    <x-input
                                        wire:model="search"
                                        placeholder="Search"
                                    />
                                </div>
                            </div>
                            <x-table.table>
                                <x-slot name="thead">
                                    <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                    <x-table.table-header class="text-left" value="IDENTITY NO." sort="" />
                                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                    <x-table.table-header class="text-left" value="NAME" sort="" />
                                    <x-table.table-header class="text-left" value="Action" sort="" />
                                </x-slot>
                                <x-slot name="tbody">
                                    <tr>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <x-button
                                                x-on:click="close"
                                                sm
                                                icon="plus"
                                                primary
                                                label="Select"
                                            />
                                        </x-table.table-body>
                                    </tr>
                                </x-slot>
                            </x-table.table>
                        </div>
                    </x-modal.card>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 py-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                <x-card title="Category">
                    <x-tab.basic-title name="0" wire:click="selectType('cheque')">
                        <x-icon name="credit-card" class="w-6 h-6 mr-2"/>
                        Cheque
                    </x-tab.basic-title>
                    <x-tab.basic-title name="1" wire:click="selectType('cash')">
                        <x-icon name="cash" class="w-6 h-6 mr-2"/>
                        Cash/CDM
                    </x-tab.basic-title>
                    <x-tab.basic-title name="2" wire:click="selectType('SI')">
                        <x-icon name="cash" class="w-6 h-6 mr-2"/>
                        IBT/SI
                    </x-tab.basic-title>
                </x-card>
            </div>
            <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                <div wire:loading wire:target="selectType">
                    @include('misc.loading')
                </div>
                <x-card title="{{$type == 'cheque' ? 'Cheque' : ($type == 'cash' ? 'Cash' : 'IBT/SI') }} Details" >
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @if($type == 'cheque')
                            <x-input
                                label="Cheque Date"
                                type="date"
                                wire:model=""
                            />
                        @endif

                        @if($type == 'SI')
                            <x-native-select label="Bank"  wire:model="">
                                <option value=""></option>
                            </x-native-select>
                        @endif

                        <x-input
                            label="Document No"
                            wire:model=""
                        />

                        <x-input
                            label="Amount"
                            wire:model=""
                        />

                        <x-input
                            label="Transaction Date"
                            type="date"
                            wire:model=""
                        />

                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <x-textarea label="Remarks" wire:model="" />
                    </div>
                    <x-slot name="footer">
                        <div class="flex items-center justify-end">
                            <x-button
                                sm
                                icon="clipboard-check"
                                primary
                                label="Save"
                            />
                        </div>
                    </x-slot>
                </x-card>
            </div>
        </div>
    </div>
</div>
