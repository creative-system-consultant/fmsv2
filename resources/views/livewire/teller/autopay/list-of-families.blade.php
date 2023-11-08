<div>
    <x-card title="LIST of Families (Autopay)">
        <div class="flex items-center justify-between space-x-2">
            <x-button
                xs
                icon="plus"
                green
                label="Create"
                wire:click="new"
            />
            <x-button
                sm
                icon="document-report"
                green
                label="Excel"
                wire:click="generateExcel"
            />
        </div>

        <div class="mt-4">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="STAFF NO MAIN" sort="" />
                    <x-table.table-header class="text-left" value="MEMBER NO MAIN" sort="" />
                    <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                    <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                    <x-table.table-header class="text-left" value="IC NO" sort="" />
                    <x-table.table-header class="text-left" value="CODE" sort="" />
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-center" value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($data as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{$item->STAFF_NO_MAIN}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->MEMBERNO_MAIN}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->STAFF_NO}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->MEMBER_NO}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->NO_IC}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{$item->CODE}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{$item->NAME}}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                <p>{{ number_format($item->AMOUNT, 2) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button
                                        xs
                                        icon="pencil-alt"
                                        primary
                                        label="Edit"
                                        wire:click="edit('{{ $item->NO_IC }}')"
                                    />
                                    <x-button
                                        wire:click="delete('{{ $item->NO_IC }}')"
                                        xs
                                        icon="trash"
                                        red
                                        label="Delete"
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                    @empty
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                                <x-no-data title="No data"/>
                            </x-table.table-body>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

        <div class="mt-4">
            {{ $data->links('livewire::pagination-links') }}
        </div>

        <!-- general modal -->
        <x-modal.card title="{{ $modalName }}" align="center" blur wire:model.defer="generalModal" max-width="6xl" hide-close="true">
            <div >
                <div class="pb-10">
                    <h1 class="pb-2 font-semibold text-primary-500">Search Member</h1>
                    <livewire:teller.autopay.customer-search sub=true />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <x-input
                        wire:model="staffNoMain"
                        label="Staff No Main"
                        placeholder=""
                        disabled
                    />
                    <x-input
                        wire:model="memberNoMain"
                        label="Member No Main"
                        placeholder=""
                        disabled
                    />
                    <x-input
                        wire:model="staffNo"
                        label="Staff No"
                        placeholder=""
                        disabled
                    />
                    <x-input
                        wire:model="memberNo"
                        label="Member No"
                        placeholder=""
                        disabled
                    />
                    <x-input
                        wire:model="icNo"
                        label="IC No"
                        placeholder=""
                        disabled
                    />
                    <x-input
                        wire:model="name"
                        label="Name"
                        placeholder=""
                        disabled
                    />
                    <x-select
                        label="Code"
                        placeholder="-- PLEASE SELECT --"
                        wire:model="code"
                    >
                        @if($employer) {{-- cater event malfunction triggered --}}
                            @foreach ($employer as $item)
                                <x-select.option label="{{ $item->employer_id }}" value="{{ $item->employer_id }}" />
                            @endforeach
                        @endif
                    </x-select>
                    <x-input
                        wire:model="amount"
                        label="Amount"
                        placeholder=""
                    />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-2">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="{{ $method }}" />
                </div>
            </x-slot>
        </x-modal.card>

        {{-- <!-- modal Edit auto family -->
        <x-modal.card title="Edit Autopay Family" align="start" blur wire:model.defer="edit-auto-family" max-width="6xl" hide-close="true">
            <div  x-data="{search: 0 }">
                <div>
                    <div class="pb-10" x-show="search == 1">
                        <h1 class="pb-2 font-semibold text-primary-500">Search Main Member</h1>
                        <div class="flex flex-col mb-4 space-y-2 sm:items-center sm:space-x-2 sm:flex-row">
                            <x-label label="Search :"/>
                            <div>
                                <x-native-select  wire:model.live="search_by">
                                    <option value="">Name</option>
                                    <option value="">Identity No</option>
                                    <option value="">Membership Id</option>
                                    <option value="">Account No</option>
                                </x-native-select>
                            </div>

                            <div class="w-full sm:w-64">
                                <x-input wire:model.lazy="search" placeholder="Search" />
                            </div>
                        </div>
                        <x-table.table>
                            <x-slot name="thead">
                                <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                <x-table.table-header class="text-left" value="NAME" sort="" />
                                <x-table.table-header class="text-left" value="STATUS" sort="" />
                                <x-table.table-header class="text-left" value="ACTION" sort="" />
                            </x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                        581218055265
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        11263
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        A JALAL BIN MD SHAH
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        ACTIVE
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <div class="flex items-center space-x-2">
                                            <x-button
                                                wire:click=""
                                                xs
                                                icon="plus"
                                                primary
                                                label="Select"
                                            />
                                        </div>
                                    </x-table.table-body>
                                </tr>
                            </x-slot>
                        </x-table.table>
                    </div>

                    <div class="pb-10" x-show="search == 2">
                        <h1 class="pb-2 font-semibold text-yellow-500">Search Sub Member</h1>
                        <div class="flex flex-col mb-4 space-y-2 sm:items-center sm:space-x-2 sm:flex-row">
                            <x-label label="Search :"/>
                            <div>
                                <x-native-select  wire:model.live="search_by">
                                    <option value="">Name</option>
                                    <option value="">Identity No</option>
                                    <option value="">Membership Id</option>
                                    <option value="">Account No</option>
                                </x-native-select>
                            </div>

                            <div class="w-full sm:w-64">
                                <x-input wire:model.lazy="search" placeholder="Search" />
                            </div>
                        </div>
                        <x-table.table>
                            <x-slot name="thead">
                                <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                <x-table.table-header class="text-left" value="NAME" sort="" />
                                <x-table.table-header class="text-left" value="STATUS" sort="" />
                                <x-table.table-header class="text-left" value="ACTION" sort="" />
                            </x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                        581218055265
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        11263
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        A JALAL BIN MD SHAH
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        ACTIVE
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <div class="flex items-center space-x-2">
                                            <x-button
                                                wire:click=""
                                                xs
                                                icon="plus"
                                                primary
                                                label="Select"
                                            />
                                        </div>
                                    </x-table.table-body>
                                </tr>
                            </x-slot>
                        </x-table.table>
                    </div>
                </div>

                <div>
                    <div class="flex justify-end">
                        <x-button
                            xs
                            icon="search"
                            primary
                            label="Search Main"
                            @click="search = 1"
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-input
                            wire:model=""
                            label="Staff No Main"
                            placeholder=""
                            disabled
                        />
                        <x-input
                            wire:model=""
                            label="Member No Main"
                            placeholder=""
                            disabled
                        />
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-button
                            xs
                            icon="search"
                            warning
                            label="Search Sub"
                            @click="search = 2"
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-input
                            wire:model=""
                            label="Staff No"
                            placeholder=""
                            disabled
                        />
                        <x-input
                            wire:model=""
                            label="Member No"
                            placeholder=""
                            disabled
                        />
                        <x-input
                            wire:model=""
                            label="IC No"
                            placeholder=""
                            disabled
                        />
                        <x-input
                            wire:model=""
                            label="Name"
                            placeholder=""
                            disabled
                        />
                        <x-select
                            label="Code"
                            placeholder="-- PLEASE SELECT --"
                            minItemsForSearch="1"
                            wire:model.live=""
                        >
                            <x-select.option label="1" value="1" />
                        </x-select>
                        <x-input
                            wire:model=""
                            label="Amount"
                            placeholder=""
                        />
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-2">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="save" />
                </div>
            </x-slot>
        </x-modal.card> --}}
    </x-card>
</div>
