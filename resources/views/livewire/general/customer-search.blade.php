<div>
    <div class="w-full p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                <div class="w-full md:w-96">
                    <x-input
                        label="Name :"
                        wire:model="name"
                        disabled
                    />
                </div>
                <div class="w-full md:w-64">
                    <x-input
                        label="Membership No :"
                        wire:model="refNo"
                        disabled
                    />
                </div>
                <x-inputs.currency
                    class="!pl-[2.5rem]"
                    label="Amount"
                    prefix="RM"
                    thousands=","
                    decimal="."
                    wire:model="totalContribution"
                    disabled
                />
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
                                <x-native-select  wire:model="searchBy">
                                    <option value="name">Name</option>
                                    <option value="identity_no">Identity No</option>
                                    <option value="ref_no">Membership Id</option>
                                    <option value="staff_no">Staff No</option>
                                </x-native-select>
                            </div>

                            <div class="w-64">
                                <x-input
                                    wire:model.lazy="search"
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
                                @forelse ($customers as $item)
                                    <tr>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <p>{{$item->staff_no}}</p>
                                        </x-table.table-body>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <p>{{$item->identity_no}}</p>
                                        </x-table.table-body>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <p>{{$item->ref_no}}</p>
                                        </x-table.table-body>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <p>{{$item->name}}</p>
                                        </x-table.table-body>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <x-button
                                                x-on:click="close"
                                                sm
                                                icon="plus"
                                                primary
                                                label="Select"
                                                wire:click="selectedUuid('{{ $item->uuid }}')"
                                            />
                                        </x-table.table-body>
                                    </tr>
                                @empty
                                    <tr class="">
                                        <x-table.table-body colspan="5" class="text-xs font-medium text-gray-700 ">
                                            <div class="flex justify-center text-center">
                                                <p>
                                                    No data
                                                </p>
                                            </div>
                                        </x-table.table-body>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-table.table>
                    </div>
                    <div class="mt-4">
                        {{ $customers->links('livewire::pagination-links') }}
                    </div>
                </x-modal.card>
            </div>
        </div>
    </div>
</div>