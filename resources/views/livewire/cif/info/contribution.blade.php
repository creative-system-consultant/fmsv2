<div>
    <x-card title="Contribution Information">
        <div class="grid grid-cols-3 gap-3">
            <x-input  label="Total" placeholder="" />
            <x-input  label="Last Payment Amount" placeholder="" />
            <x-input  label="Monthly" placeholder="" />
            <x-input  label="Last Withraw Amount" placeholder="" />
            <x-input  label="Last Withdraw Date" placeholder="" />
            <x-input  label="Number of Withdraw" placeholder="" />
            <x-input  label="Total of Withdraw" placeholder="" />

            <div>
            <x-button blue label="Contribution History" class="margin-left: 10px;"/>
            </div>

       </div>
    </x-card>


    <div style="margin-top: 50px;">
        <div style="margin-bottom: 50px;">
            <ul class="flex border-b">
                <li>
                    <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="testTab('contribution-statements')">
                        <div class="flex flex-col items-start overflow-x-auto md:flex-row md:items-center">
                        <x-icon name="clipboard-list" class="w-6 h-6 mr-2"/>
                        <p icon="clipboard-list">Contribution Statements</p>
                        </div>
                    </a>
                </li>

                <li>
                    <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="testTab('contribution-out')">
                        <div class="flex flex-col items-start overflow-x-auto md:flex-row md:items-center">
                        <x-icon name="clipboard-list" class="w-6 h-6 mr-2"/>
                        <p icon="clipboard-list">Contribution Out Statements</p>
                        </div>
                    </a>
                </li>

            </ul>
        </div>

        <div style="margin-bottom: 50px;">
            <div id="tab-contribution-statements" >
                <x-card title="Contribution Statements">
                    <div class="grid grid-cols-3 gap-3">
                        <x-input  type="date"  label="Start Date" value="" wire:model="" :editable=true/>
                        <x-input  type="date"  label="End Date" value="" wire:model="" :editable=true/>

                        <div>
                        <x-button sm icon="document-report" blue label="Excel" class="margin-left: 50px;"/>
                        <x-button sm icon="document-report" blue label="PDF" class="margin-left: 50px;"/>
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

            <div id="tab-contribution-out" >
                <x-card title="Contribution Out Statements">
                    <div class="grid grid-cols-3 gap-3">
                        <x-input  type="date"  label="Start Date" value="" wire:model="" :editable=true/>
                        <x-input  type="date"  label="End Date" value="" wire:model="" :editable=true/>

                        <div>
                            <x-button sm icon="document-report" blue label="Excel" class="margin-left: 50px;"/>
                            <x-button sm icon="document-report" blue label="PDF" class="margin-left: 50px;"/>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Show the first tab content
    var defaultTab = 'contribution-statements';
    testTab(defaultTab);
    });

    function testTab(tabId) {
        var tabs = ['contribution-statements','contribution-out'];
        for (var i = 0; i < tabs.length; i++) {
            var content = document.getElementById('tab-' + tabs[i]);
            if (tabs[i] === tabId) {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        }
    }
</script>
