<div>
    <div class="grid grid-cols-1 ">
        <x-card title="Third Party Reversal">
            <div class="flex items-center space-x-2 ">
                <x-label label="Search :"/>
                <div>
                    <x-native-select  wire:model.live="searchBy">
                        <option value="FMS.THIRDPARTY_STATEMENTS.mbr_no">Membership No</option>
                        <option value="FMS.THIRDPARTY_STATEMENTS.doc_no">Document No</option>
                        <option value="CIF.CUSTOMERS.name">Name</option>
                        <option value="FMS.THIRDPARTY_STATEMENTS.transaction_date">Transaction Date</option>
                    </x-native-select>
                </div>

                <div class="w-64">
                    <x-input
                        wire:model.lazy="search"
                        placeholder="Search"
                    />
                </div>
            </div>

            <div class="mt-4">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header value="MEMBERSHIP NO" sort="" class="text-left" />
                        <x-table.table-header value="NAME" sort="" class="text-left" />
                        <x-table.table-header value="DOCUMENT NO" sort="" class="text-left" />
                        <x-table.table-header value="DESCRIPTION" sort="" class="text-left" />
                        <x-table.table-header value="AMOUNT" sort="" class="text-right" />
                        <x-table.table-header value="TRANSACTION DATE" sort="" class="text-left" />
                        <x-table.table-header value="ACTION" sort="" class="text-left" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($dataTable as $data)
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ $data->mbr_no }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ $data->name }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ $data->doc_no }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ $data->description }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    {{ number_format($data->transaction_amount, 2) }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ date('d/m/Y', strtotime($data->transaction_date)) }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                        @if ($data->trx_group == 'THIRD PARTY PMT' && $data->ref_id_reversal == NULL)
                                            <x-button sm icon="refresh" primary label="Reverse" wire:click="reverse('{{ $data->id }}')" />
                                        @else
                                            <x-badge md icon="check-circle" positive label="Done Reverse" />
                                        @endif
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

                <div class="py-4">
                    {{ $dataTable->links('livewire::pagination-links') }}
                </div>
            </div>
        </x-card>

        {{-- modal --}}
        <div>
            <x-modal.card title="{{ strtoupper('Third Party Reversal') }} CONFIRMATION" align="center" fullscreen="true" blur wire:model.defer="reversalModal">
                <div class="mb-4">
                    <x-card title="Customer Information">
                        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
                            <x-input
                                label="Name"
                                wire:model=""
                                disabled
                            />
                            <x-input
                                label="Membership No"
                                wire:model=""
                                disabled
                            />
                            <x-input
                                label="Account No"
                                wire:model=""
                                disabled
                            />
                        </div>
                    </x-card>
                </div>

                <div class="mb-4">
                    <x-card title="Transaction Information">
                        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
                            <x-inputs.currency
                                class="!pl-[2.5rem]"
                                label="Amount"
                                prefix="RM"
                                thousands=","
                                decimal="."
                                wire:model=""
                                disabled
                            />
                            <x-input
                                label="Transaction Description"
                                wire:model=""
                                disabled
                            />
                            <x-input
                                label="Document No"
                                wire:model=""
                                disabled
                            />
                            <x-input
                                label="remarks"
                                wire:model=""
                                disabled
                            />
                            <x-input
                                label="Trasaction Date"
                                wire:model=""
                                disabled
                            />
                        </div>
                    </x-card>
                </div>

                <div class="mb-4">
                    <x-card title="List Of Overlap Account">
                        <x-table.table>
                            <x-slot name="thead">
                                <x-table.table-header class="text-left" value="OVERLAP ACCOUNT" sort=""  />
                                <x-table.table-header class="text-left" value="PRODUCTS" sort=""  />
                                <x-table.table-header class="text-right" value="SETTLEMENT AMOUNT" sort=""  />
                                <x-table.table-header class="text-right" value="PRINCIPAL AMOUNT" sort=""  />
                                <x-table.table-header class="text-right" value="PROFIT AMOUNT" sort=""  />
                            </x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        OVERLAP ACCOUNT
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        PRODUCTS
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                        SETTLEMENT AMOUNT
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                        PRINCIPAL AMOUNT
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                        PROFIT AMOUNT
                                    </x-table.table-body>
                                </tr>

                            </x-slot>
                        </x-table.table>
                    </x-card>
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-2">
                        <x-button flat label="Close" x-on:click="close" />
                        <x-button primary label="Confirm" onclick="$openModal('remarksModal')" />
                    </div>
                </x-slot>
            </x-modal.card>

            <x-modal.card title="Are you sure you want to reverse this transaction?" align="center" max-width="2xl" blur wire:model.defer="remarksModal">
                <div class="grid grid-cols-1 gap-2 p-3">
                    <x-textarea
                        label="Remarks"
                        wire:model=""
                    />
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-2">
                        <x-button flat label="Close" x-on:click="close" />
                        <x-button red label="Reverse" />
                    </div>
                </x-slot>
            </x-modal.card>
        </div>
    </div>
</div>
