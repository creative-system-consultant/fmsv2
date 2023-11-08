<div>
    <div class="grid grid-cols-1 ">
        <x-card title="Financing Repayment Reversal">
            <div class="flex items-center space-x-2 ">
                <x-label label="Search :"/>
                <div>
                    <x-native-select  wire:model.live="searchBy">
                        <option value="FMS.ACCOUNT_STATEMENTS.account_no">Account No</option>
                        <option value="FMS.ACCOUNT_STATEMENTS.doc_no">Document No</option>
                        <option value="CIF.CUSTOMERS.name">Name</option>
                        <option value="FMS.ACCOUNT_MASTERS.mbr_no">Membership No</option>
                        <option value="FMS.ACCOUNT_STATEMENTS.transaction_date">Transaction Date</option>
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
                        <x-table.table-header value="ACCOUNT NO" sort="" class="text-left" />
                        <x-table.table-header value="AMOUNT" sort="" class="text-right" />
                        <x-table.table-header value="DOCUMENT NO" sort="" class="text-left" />
                        <x-table.table-header value="DESCRIPTION" sort="" class="text-left" />
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
                                    {{ $data->account_no }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    {{ number_format($data->amount, 2) }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                    {{ $data->doc_no }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ $data->description }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                    {{ date('d/m/Y', strtotime($data->transaction_date)) }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-xs font-medium text-left text-gray-700">
                                        @if ($data->ref_id_reversal == NULL)
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
            <x-modal.card title="FINANCING REPAYMENT REVERSAL CONFIRMATION" align="center" fullscreen="true" blur wire:model.defer="reversalModal">
                <div class="mb-4">
                    <x-card title="Customer Information">
                        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
                            <x-input
                                label="Name"
                                wire:model="name"
                                disabled
                            />
                            <x-input
                                label="Membership No"
                                wire:model="mbrNo"
                                disabled
                            />
                            <x-input
                                label="Account No"
                                wire:model="accountNo"
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
                                wire:model="amount"
                                disabled
                            />
                            <x-input
                                label="Transaction Description"
                                wire:model="trxDesc"
                                disabled
                            />
                            <x-input
                                label="Document No"
                                wire:model="docNo"
                                disabled
                            />
                            <x-input
                                label="Trasaction Date"
                                wire:model="trxDate"
                                disabled
                            />
                            <x-input
                                label="Remarks"
                                wire:model="remarks"
                                disabled
                            />
                        </div>
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
                        wire:model="confirmRemark"
                    />
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-2">
                        <x-button flat label="Close" x-on:click="close" />
                        <x-button red label="Reverse" wire:click="confirmReverse"/>
                    </div>
                </x-slot>
            </x-modal.card>
        </div>
    </div>
</div>