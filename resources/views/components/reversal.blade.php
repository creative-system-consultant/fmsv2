<div>
    <div class="grid grid-cols-1 ">
        <x-card title="{{ $title }}">
            <div class="flex items-center space-x-2 ">
                <x-label label="Search :"/>
                <div>
                    {{ $searchBy }}
                </div>

                <div class="w-64">
                    <x-input
                        wire:model.lazy="search"
                        placeholder="Search"
                    />
                </div>
            </div>

            @if($dataTable && $dataTable->count() > 0)
            <?php $firstRow = $dataTable->first(); ?>

                <div class="mt-4">
                    @if($firstRow)
                        <x-table.table>
                            <x-slot name="thead">
                                @foreach($firstRow as $column => $cell)
                                    @php
                                        $alignment = 'text-left'; // Default to left

                                        if ($cell['align'] === 'right') {
                                            $alignment = 'text-right';
                                        } elseif ($cell['align'] === 'center') {
                                            $alignment = 'text-center';
                                        }
                                    @endphp
                                    <x-table.table-header value="{{ $column }}" sort="" class="{{ $alignment }}" />
                                @endforeach
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach($dataTable as $row)
                                    <tr>
                                        @foreach($row as $column => $cell)
                                            @php
                                                $alignment = 'text-left'; // Default to left

                                                if ($cell['align'] === 'right') {
                                                    $alignment = 'text-right';
                                                } elseif ($cell['align'] === 'center') {
                                                    $alignment = 'text-center';
                                                }
                                            @endphp
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 {{ $alignment }}">
                                                @if($column == 'ACTION')
                                                    @if($cell['value'] == 'DONE')
                                                        <x-badge md icon="check-circle" positive label="Done Reverse" />
                                                    @else
                                                        <x-button sm icon="refresh" primary label="Reverse" wire:click="{{ $cell['value'] }}" />
                                                    @endif
                                                @else
                                                    {{ $cell['value'] }}
                                                @endif
                                            </x-table.table-body>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-table.table>

                        <div class="py-4">
                            {{ $dataTable->links('livewire::pagination-links') }}
                        </div>
                    @endif
                </div>
            @else
                <div class="mt-4">
                    <label for="fileInput" class="flex items-center justify-center w-full h-24 py-4 border-2 border-dotted 'bg-rose-50 dark:border-rose-700 dark:bg-rose-800 rounded-xl border-rose-400">
                        <div class="flex items-center justify-center space-x-2">
                                <x-icon name="x-circle" class="w-5 h-5 text-rose-600 animate-bounce" />
                                <p class="text-xs leading-5 text-center text-rose-600">
                                    NO DATA AVAILABLE
                                </p>
                        </div>
                    </label>
                </div>
            @endif
        </x-card>

        {{-- modal --}}
        <div>
            <x-modal.card title="{{ strtoupper($title) }} CONFIRMATION" align="center" fullscreen="true" blur wire:model.defer="reversalModal">
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
