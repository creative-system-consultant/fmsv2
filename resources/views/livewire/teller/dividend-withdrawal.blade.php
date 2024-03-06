<div>
    <div class="grid grid-cols-1">
        <div>
            <div class="w-full p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                <div>
                    <div class="grid grid-cols-4 gap-4">
                        <x-input label="Name" wire:model="name" disabled />
                        <x-input label="Membership No" wire:model="searchMbrNoValue" disabled />
                        <x-inputs.currency
                            class="!pl-[2.5rem]"
                            label="Total Dividen"
                            prefix="RM"
                            thousands=","
                            decimal="."
                            wire:model="searchBalDividenValue"
                            disabled
                        />
                    </div>
                    <div class="flex justify-end mt-3">
                        <x-button
                            onclick="$openModal('search-modal')"
                            sm
                            icon="search"
                            primary
                            label="Search"
                        />

                        <x-modal.card title="Search Listing Dividend Withdrawal" align="center" max-width="6xl" blur wire:model.defer="search-modal">
                            <div x-data="{tab:@entangle('tabIndex')}">
                                <div class="grid grid-cols-1 sgap-4">
                                    <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                                        <div class="flex items-center ">
                                            <x-tab.title name="1" wire:click="changeTab">
                                                <div class="flex items-center text-sm spcae-x-2">
                                                    <h1>SISKOP</h1>
                                                </div>
                                            </x-tab.title>
                                            <x-tab.title name="2" wire:click="changeTab">
                                                <div class="flex items-center text-sm spcae-x-2">
                                                    <h1>FMS</h1>
                                                </div>
                                            </x-tab.title>
                                        </div>
                                    </div>

                                    <div class="flex items-center mb-4 space-x-2">
                                        <x-label label="Search :" />
                                        <div>
                                            <x-native-select wire:model.live="searchBy">
                                                <option value="CIF.CUSTOMERS.name">Name</option>
                                                <option value="CIF.CUSTOMERS.identity_no">Identity No</option>
                                                <option value="FMS.MEMBERSHIP.mbr_no">Membership Id</option>
                                                <option value="CIF.CUSTOMERS.staff_no">Staff No</option>
                                            </x-native-select>
                                        </div>

                                        <div class="w-64">
                                            <x-input wire:model.lazy="search" placeholder="Search" />
                                        </div>
                                    </div>

                                    <div x-show="tab == 1">
                                        <x-table.table>
                                            <x-slot name="thead">
                                                <x-table.table-header class="text-left" value="APPLY ID" sort="" />
                                                <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                                <x-table.table-header class="text-left" value="IC NO" sort="" />
                                                <x-table.table-header class="text-left" value="NAME" sort="" />
                                                <x-table.table-header class="text-left" value="APPLY AMOUNT" sort="" />
                                                <x-table.table-header class="text-left" value="TOTAL DIVIDEND" sort="" />
                                                <x-table.table-header class="text-left" value="ACTION" sort="" />
                                            </x-slot>
                                            <x-slot name="tbody">
                                                @forelse ($siskopDatas as $siskopData)
                                                <tr>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $siskopData->apply_id }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $siskopData->mbr_no }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $siskopData->identity_no }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $siskopData->name }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $siskopData->div_cash_approved }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $siskopData->bal_dividen }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <x-button x-on:click="close" sm icon="plus" primary label="Select" wire:click="selectedMbrSiskop('{{ $siskopData->mbr_no }}')" />
                                                    </x-table.table-body>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <x-table.table-body colspan="5" class="text-xs font-medium text-gray-700 ">
                                                        <div class="flex justify-center text-center">
                                                            <p>No data</p>
                                                        </div>
                                                    </x-table.table-body>
                                                </tr>
                                                @endforelse
                                            </x-slot>
                                        </x-table.table>
                                        <div class="mt-4">
                                            {{ $siskopDatas->links('livewire::pagination-links') }}
                                        </div>
                                    </div>

                                    <div x-show="tab == 2">
                                        <x-table.table>
                                            <x-slot name="thead">
                                                <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                                <x-table.table-header class="text-left" value="IC NO" sort="" />
                                                <x-table.table-header class="text-left" value="NAME" sort="" />
                                                <x-table.table-header class="text-left" value="APPLY AMOUNT" sort="" />
                                                <x-table.table-header class="text-left" value="TOTAL DIVIDEND" sort="" />
                                                <x-table.table-header class="text-left" value="ACTION" sort="" />
                                            </x-slot>
                                            <x-slot name="tbody">
                                                @forelse ($fmsDatas as $fmsData)
                                                <tr>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $fmsData->mbr_no }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $fmsData->identity_no }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $fmsData->name }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $fmsData->bal_div_pending_withdrawal }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <p>{{ $fmsData->bal_dividen }}</p>
                                                    </x-table.table-body>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        <x-button x-on:click="close" sm icon="plus" primary label="Select" wire:click="selectedMbr('{{ $fmsData->mbr_no }}')" />
                                                    </x-table.table-body>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <x-table.table-body colspan="5" class="text-xs font-medium text-gray-700 ">
                                                        <div class="flex justify-center text-center">
                                                            <p>No data</p>
                                                        </div>
                                                    </x-table.table-body>
                                                </tr>
                                                @endforelse
                                            </x-slot>
                                        </x-table.table>
                                        <div class="mt-4">
                                            {{ $fmsDatas->links('livewire::pagination-links') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-modal.card>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 py-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                <x-card title="Category">
                    @foreach($categoryList as $index => $category)
                    <x-tab.basic-title name="{{ $index }}" wire:click="selectType('{{ $category['name'] }}', '{{ $category['code'] }}')">
                        <x-icon name="{{ $category['icon'] }}" class="w-6 h-6 mr-2" />
                        {{ strtoupper($category['name']) }}
                    </x-tab.basic-title>
                    @endforeach
                </x-card>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <div>
                    <div>
                        <div wire:loading wire:target="saveTransaction,confirmSaveTransaction">
                            @include('misc.loading')
                        </div>

                        @php
                        $title = strtoupper($selectedType) . ' DETAILS';
                        @endphp

                        <x-card title="{{ $title }}">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="{{ $selectedType == 'cheque' ? ' block' : 'hidden'}}">
                                    <x-datetime-picker label="Cheque Date" wire:model="chequeDate" without-time=true display-format="DD/MM/YYYY" min="{{ $startDate }}" max="{{ $endDate }}" />
                                </div>

                                <div class=" {{ $selectedType == 'cheque' ? ' block' : 'hidden'}}">
                                    <x-select label="Bank Customer" placeholder="-- PLEASE SELECT --" wire:model="bankMember">
                                        @foreach ($refBank as $bank)
                                        <x-select.option label="{{ $bank->description }}" value="{{ $bank->id }}" />
                                        @endforeach
                                    </x-select>
                                </div>

                                <x-select label="Bank Client" placeholder="-- PLEASE SELECT --" wire:model="bankClient">
                                    @foreach ($refBankIbt as $bankIbt)
                                    <x-select.option label="{{ $bankIbt->description }}" value="{{ $bankIbt->id }}" />
                                    @endforeach
                                </x-select>

                                <x-input label="Document No" wire:model="docNo" />

                                <x-inputs.currency class="!pl-[2.5rem]" label="Amount" prefix="RM" thousands="," decimal="." wire:model="txnAmt" />

                                <x-datetime-picker label="Transaction Date" wire:model="txnDate" without-time=true display-format="DD/MM/YYYY" min="{{ $startDate }}" max="{{ $endDate }}" />
                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-4">
                                <x-textarea label="Remarks" wire:model="remarks" />
                            </div>

                            @if($saveButton)
                            <x-slot name="footer">
                                <div class="flex items-center justify-end">
                                    <x-button sm icon="clipboard-check" primary label="Save" wire:click="saveTransaction" />
                                </div>
                            </x-slot>
                            @endif
                        </x-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
