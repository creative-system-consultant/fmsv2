<div>
    <div class="grid grid-cols-1 px-4">
        <div class="flex items-center space-x-2">
            <x-label label="Search :"/>
            <div class="w-64">
                <x-input
                    wire:model="search"
                    placeholder="Search"
                />
            </div>
        </div>

        <div class="my-6">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                    <x-table.table-header class="text-left" value="INTRODUCER MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="INTRODUCER NAME" sort="" />
                    <x-table.table-header class="text-left" value="INTRODUCER IC NO" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse($lists as $list)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                {{ $list->customer->mbr_no }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $list->customer->cifCustomer->name }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $list->introducer->mbr_no }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $list->introducer->cifCustomer->name }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $list->introducer->cifCustomer->identity_no }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button
                                        xs
                                        icon="cursor-click"
                                        label="select"
                                        green
                                        wire:click="selectIntroducer('{{ $list->customer->mbr_no }}')"
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                    @empty
                        <tr>
                            <x-table.table-body colspan="6" class="text-xs font-medium text-center text-gray-700">
                                NO DATA
                            </x-table.table-body>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

        <div class="mb-4">
            <livewire:teller.general.members-bank-info :ic=$ic />
        </div>

        <div>
            <div>
                <div wire:loading wire:target=" saveTransaction,confirmSaveTransaction">
                    @include('misc.loading')
                </div>

                <x-card title="TRANSACTION DETAILS">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
