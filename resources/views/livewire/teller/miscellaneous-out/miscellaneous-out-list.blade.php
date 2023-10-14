<div>
    @if($selectedMbr)
        @livewire('teller.miscellaneous-out.miscellaneous-out-create', ['mbrNo' => $selectedMbr])
    @else
        <div class="grid grid-cols-1">
            <div class="flex items-center space-x-2">
                <x-label label="Search :"/>
                <div>
                    <x-native-select wire:model="searchBy">
                        <option value="CIF.CUSTOMERS.name">Name</option>
                        <option value="CIF.CUSTOMERS.identity_no">Identity No</option>
                        <option value="FMS.MEMBERSHIP.ref_no">Membership Id</option>
                    </x-native-select>
                </div>

                <div class="w-64">
                    <x-input
                        wire:model.lazy="search"
                        placeholder="Search"
                    />
                </div>
            </div>

            <div style="margin-top: 30px;">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="MEMBERSHIP ID" sort="" />
                        <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-center" value="MISCELLANEOUS AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="PAY TO" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($members as $item)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->mbrno }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->identity_no }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $item->name }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                                    {{ number_format($item->misc_amt, 2) }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button
                                        wire:click="selectMbr('{{ $item->mbrno }}')"
                                        sm
                                        icon="eye"
                                        primary
                                        label="View"
                                    />
                                </x-table.table-body>
                            </tr>
                        @empty
                            <tr>
                                <x-table.table-body colspan="5" class="text-xs font-medium text-center text-gray-700 ">
                                    <p>NO DATA</p>
                                </x-table.table-body>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.table>
            </div>
            <div class="mt-4">
                {{ $members->links('livewire::pagination-links') }}
            </div>
        </div>
    @endif
</div>
