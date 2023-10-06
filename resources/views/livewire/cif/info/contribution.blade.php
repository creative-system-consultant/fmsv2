<div>
    <x-card title="Contribution Information">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
            <x-input label="Total" wire:model="" disabled />
            <x-input label="Last Payment Amount" wire:model="" disabled />
            <x-input label="Monthly" wire:model="" disabled />
            <x-input label="Last Withraw Amount"  wire:model="" disabled />
            <x-input label="Last Withdraw Date"  wire:model="" disabled/>
            <x-input label="Number of Withdraw" wire:model="" disabled />
            <x-input label="Total of Withdraw" wire:model="" disabled />

            <div class="mt-6">
                <x-button 
                    onclick="$openModal('contribution-histrory-modal')" 
                    primary 
                    label="Contribution History" 
                    sm
                />
            </div>

            <x-modal.card  title="Monthly Contribution History-In Details" align="center"  wire:model.defer="contribution-histrory-modal">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-center" value="AMOUNT" sort="" />
                        <x-table.table-header class="text-center" value="EFFECTIVE DATE" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </x-modal.card>
        </div>
    </x-card>


    <div class="mt-12" x-data="{tab:0}">
        <div class="bg-gray-50 rounded-lg shadow-sm mb-4 dark:bg-gray-900">
            <div class="flex items-center space-x-4">
                <x-tab.title name="0">
                    <div class="flex items-center spcae-x-2 text-sm">
                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                        <h1>Contribution Statements</h1>
                    </div>
                </x-tab.title>
                <x-tab.title name="1">
                    <div class="flex items-center spcae-x-2 text-sm">
                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                        <h1>Contribution Out Statements</h1>
                    </div>
                </x-tab.title>
            </div>
        </div>

        <div>

            <div x-show="tab == 0">
                <x-card title="Contribution Statements">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <x-input type="date"  label="Start Date" value="" wire:model=""/>
                            <x-input type="date"  label="End Date" value="" wire:model=""/>
                        </div>

                        <div class="mt-5">
                            <x-button sm icon="document-report" green label="Excel"/>
                            <x-button sm icon="document-report" orange label="PDF" />
                        </div>
                    </div>

                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Date" sort="" />
                            <x-table.table-header class="text-left" value="Transaction Description" sort="" />
                            <x-table.table-header class="text-left" value="Remark" sort="" />
                            <x-table.table-header class="text-left " value="Amount" sort="" />
                            <x-table.table-header class="text-left " value="Total Amount" sort="" />
                            <x-table.table-header class="text-left " value="Created By" sort="" />
                            <x-table.table-header class="text-left " value="Created At" sort="" />
                            <x-table.table-header class="text-left " value="Action" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                            </tr>
                        </x-slot>
                    </x-table.table>

                </x-card>
            </div>

            <div  x-show="tab == 1">
                <x-card title="Contribution Out Statements">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <x-input type="date"  label="Start Date" value="" wire:model=""/>
                            <x-input type="date"  label="End Date" value="" wire:model=""/>
                        </div>

                        <div class="mt-5">
                            <x-button sm icon="document-report" green label="Excel"/>
                            <x-button sm icon="document-report" orange label="PDF" />
                        </div>
                    </div>

                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Date" sort="" />
                            <x-table.table-header class="text-left" value="Transaction Description" sort="" />
                            <x-table.table-header class="text-left" value="Remark" sort="" />
                            <x-table.table-header class="text-left " value="Amount" sort="" />
                            <x-table.table-header class="text-left " value="Total Amount" sort="" />
                            <x-table.table-header class="text-left " value="Action" sort="" />
                        </x-slot>

                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>

                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">

                                </x-table.table-body>


                            </tr>

                        </x-slot>
                    </x-table.table>
                </x-card>
            </div>
        </div>
    </div>
</div>
