<div>
    <x-container title="Account Overlap" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class="flex items-center space-x-2">
                <x-label label="Search :"/>
                <div>
                    <x-native-select  wire:model="model">
                        <option value="">Name</option>
                        <option value="">Identity No</option>
                        <option value="">Membership Id</option>
                        <option value="">Staff No</option>
                    </x-native-select>
                </div>

                <div class="w-64">
                    <x-input
                        wire:model="search"
                        placeholder="Search"
                    />
                </div>
            </div>

            <div style="margin-top: 30px;">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="ACCOUNT ID" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left" value="EXPIRY DATE" sort="" />
                        <x-table.table-header class="text-right" value="MONTHLY PAYMENTS" sort="" />
                        <x-table.table-header class="text-right" value="SETTLEMENT AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="PRINCIPAL AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="PROFIT AMOUNT" sort="" />
                        <x-table.table-header class="text-center" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                2
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                116111506038892
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                01/01/1970
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                97.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                2,301.00
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                                2,000.57
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                                300.43
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                                <x-button
                                    onclick="$openModal('edit-ao')"
                                    sm
                                    icon="pencil-alt"
                                    blue
                                    label="edit"
                                />
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>

                <!-- modal Edit -->
                <x-modal.card title="Edit Virtual Account" max-width="sm" align="center" blur wire:model.defer="edit-ao">
                    <div class="grid grid-cols-1 gap-4">
                        <x-input
                            label="Principal Amount"
                            wire:model=""
                        />
                        <x-input
                            label="Profit Amount"
                            wire:model=""
                        />
                    </div>

                    <x-slot name="footer">
                        <div class="flex justify-end gap-x-4">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="Update" wire:click="" />
                        </div>
                    </x-slot>
                </x-modal.card>
            </div>

        </div>
    </x-container>
</div>
