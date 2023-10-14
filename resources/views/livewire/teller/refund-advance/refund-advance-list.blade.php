<div>
    @if($selectedAccNo)
        @livewire('teller.refund-advance.refund-advance-create', ['account_no' => $selectedAccNo])
    @else
        <div class="grid grid-cols-1">
            <div class="flex items-center space-x-2">
                <x-label label="Search :"/>
                <div>
                    <x-native-select  wire:model.live="search_by">
                        <option value="cif.customers.name">Name</option>
                        <option value="cif.customers.identity_no">Identity No</option>
                        <option value="cif.customers.ref_no">Membership Id</option>
                        <option value="fms.account_masters.account_no">Account No</option>
                    </x-native-select>
                </div>

                <div class="w-64">
                    <x-input wire:model.lazy="search" placeholder="Search" />
                </div>
            </div>

            <div class="my-6 ">
                <x-table.table loading="true" loadingtarget="search">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="MEMBERSHIP ID" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left" value="PRODUCT" sort="" />
                        <x-table.table-header class="text-left" value="DISBURSED AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="PRIN OUTSTANDING" sort="" />
                        <x-table.table-header class="text-left" value="UEI OUTSTANDING" sort="" />
                        <x-table.table-header class="text-left" value="ADV AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="BAL OUTS" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($advance as $advances)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $advances->identity_no }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $advances->ref_no }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $advances->name }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $advances->account_no }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <p>{{ $advances->products }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    <p>{{ number_format($advances->disbursed_amount, 2) }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    <p>{{ number_format($advances->prin_outstanding, 2) }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    <p>{{ number_format($advances->uei_outstanding, 2) }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    <p>{{ number_format($advances->advance_payment, 2) }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    <p>{{ number_format($advances->bal_outstanding, 2) }}</p>
                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <x-button
                                        {{-- href="{{ route('teller.teller-refund-advance-create', ['account_no' => $advances->account_no]) }}" --}}
                                        sm
                                        icon="eye"
                                        primary
                                        label="View"
                                        wire:click="selectAcc({{ $advances->account_no }})"
                                        {{-- wire:navigate --}}
                                    />
                                </x-table.table-body>
                            </tr>
                        @empty
                            <tr>
                                <x-table.table-body colspan="11" class="text-xs font-medium text-center text-gray-700 ">
                                    <p>NO DATA</p>
                                </x-table.table-body>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.table>
            </div>
            {{ $advance->links('livewire::pagination-links') }}
        </div>
    @endif
</div>
