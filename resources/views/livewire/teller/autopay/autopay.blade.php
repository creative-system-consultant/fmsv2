<div>
    <div x-data="{tab:1}">
        <x-container title="Teller" routeBackBtn="" titleBackBtn="" disableBackBtn="">
            <div class="grid grid-cols-1">
                <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center ">
                        <x-tab.title name="1">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="library" class="w-5 h-5 mr-2"/>
                                <h1>Autopay</h1>
                            </div>
                        </x-tab.title>
                        <x-tab.title name="2">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="document-text" class="w-5 h-5 mr-2"/>
                                <h1>List of Families</h1>
                            </div>
                        </x-tab.title>
                        <x-tab.title name="3">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="document-text" class="w-5 h-5 mr-2"/>
                                <h1>List of Guarantor</h1>
                            </div>
                        </x-tab.title>
                    </div>
                </div>

                <div x-show="tab == 1">
                    <x-card title="">
                        <div class="grid grid-cols-1">
                            <livewire:teller.autopay.listing-to-employer />

                            <div class="mt-10">
                                <livewire:teller.autopay.listing-from-employer />
                            </div>
                        </div>
                        <div class="mt-10">
                            <livewire:teller.autopay.details-exception />
                        </div>
                    </x-card>
                </div>

                <div x-show="tab == 2">
                    <x-card title="">
                        <div class="grid grid-cols-1">
                            <livewire:teller.autopay.list-of-families lazy />
                        </div>
                    </x-card>
                </div>

                <div x-show="tab == 3">
                    <x-card title="">
                        <div class="grid grid-cols-1">
                            <livewire:teller.autopay.list-of-guarantor lazy />
                        </div>
                    </x-card>
                </div>
            </div>
        </x-container>
    </div>
</div>
