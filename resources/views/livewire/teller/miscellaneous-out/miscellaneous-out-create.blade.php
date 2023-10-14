<div>
    <x-container title="MISCELLANEOUS OUT" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="miscellaneous out list " disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class="w-full p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                    <div class="w-full md:w-96">
                        <x-input
                            label="Name :"
                            wire:model="name"
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input
                            label="Membership No :"
                            wire:model="refNo"
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-inputs.currency
                            class="!pl-[2.5rem]"
                            label="Total :"
                            prefix="RM"
                            thousands=","
                            decimal="."
                            wire:model="miscAmt"
                            disabled
                        />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 p-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
                <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                    <x-card title="Category">
                        <x-tab.basic-title name="0">
                            <x-icon name="credit-card" class="w-6 h-6 mr-2"/>
                            Contribution
                        </x-tab.basic-title>
                        <x-tab.basic-title name="1">
                            <x-icon name="cash" class="w-6 h-6 mr-2"/>
                            Members
                        </x-tab.basic-title>
                        <x-tab.basic-title name="2">
                            <x-icon name="cash" class="w-6 h-6 mr-2"/>
                            Financing
                        </x-tab.basic-title>
                        <x-tab.basic-title name="3">
                            <x-icon name="cash" class="w-6 h-6 mr-2"/>
                            Share
                        </x-tab.basic-title>
                    </x-card>
                </div>
                <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                    <div x-show="tab == 0">
                        <livewire:teller.miscellaneous-out.category.contribution :mbrNo=$mbrNo :startDate=$startDate :endDate=$endDate :miscAmt=$miscAmt />
                    </div>

                    <div x-show="tab == 1">
                        <livewire:teller.miscellaneous-out.category.members :mbrNo=$mbrNo :startDate=$startDate :endDate=$endDate :miscAmt=$miscAmt />
                    </div>

                    <div x-show="tab == 2">
                        <livewire:teller.miscellaneous-out.category.financing :mbrNo=$mbrNo />
                    </div>

                    <div x-show="tab == 3">
                        <livewire:teller.miscellaneous-out.category.share :mbrNo=$mbrNo :startDate=$startDate :endDate=$endDate :miscAmt=$miscAmt />
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>
