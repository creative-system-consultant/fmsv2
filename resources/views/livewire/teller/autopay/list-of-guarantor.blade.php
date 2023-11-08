<div>
    <x-card title=" LIST of Guarantor (Autopay)">
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
                    <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-left" value="BANK" sort="" />
                    <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                    <x-table.table-header class="text-left" value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($data as  $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                <p>{{ $item->mbrno }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ strtoupper($item->name) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->banks->description }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->account_no }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ $item->status == 'Y' ? 'YES' : 'NO' }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>{{ number_format($item->amount, 2) }}</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button
                                        xs
                                        icon="pencil-alt"
                                        primary
                                        label="Edit"
                                        wire:click="edit('{{ $item->mbrno }}')"
                                    />
                                    <x-button
                                        wire:click="delete('{{ $item->mbrno }}')"
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

            <div class="mt-4">
                {{ $data->links('livewire::pagination-links') }}
            </div>
        </div>

        {{--  general modal --}}
        <x-modal.card title="{{ $modalName }}" align="center" blur wire:model.defer="generalModal" max-width="6xl" hide-close="true">
            <div>
                <div class="pb-10">
                    <h1 class="pb-2 font-semibold text-primary-500">Search Member</h1>
                    <livewire:teller.autopay.customer-search />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <x-input
                        wire:model="mbrNo"
                        label="Member No"
                        placeholder=""
                    />
                    <x-input
                        wire:model="name"
                        label="Name"
                        placeholder=""
                    />
                    <x-select
                        label="Bank"
                        placeholder="-- PLEASE SELECT --"
                        wire:model="bank"
                    >
                        @if($refBankIbt) {{-- cater event malfunction triggered --}}
                            @foreach ($refBankIbt as $item)
                                <x-select.option label="{{ $item->description }}" value="{{ $item->id }}" />
                            @endforeach
                        @endif
                    </x-select>
                    <x-input
                        wire:model="accountNo"
                        label="Account No"
                        placeholder=""
                    />
                    <x-input
                        wire:model="amount"
                        label="Amount"
                        placeholder=""
                    />
                    <x-select
                        label="Status"
                        placeholder="-- PLEASE SELECT --"
                        wire:model="status"
                    >
                        <x-select.option label="YES" value="Y" />
                        <x-select.option label="NO" value="N" />
                    </x-select>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-2">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="{{ $method }}" />
                </div>
            </x-slot>
        </x-modal.card>
    </x-card>
</div>
