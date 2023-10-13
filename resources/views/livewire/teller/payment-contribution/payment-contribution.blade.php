<div>
    <x-container title="Payment Contribution" routeBackBtn="{{route('teller.teller-list')}}" titleBackBtn="teller list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <livewire:general.customer-search/>

            <div class="grid grid-cols-12 gap-6 p-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
                <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                    <x-card title="Category">
                        <x-tab.basic-title name="0" wire:click="selectType('cheque')">
                            <x-icon name="credit-card" class="w-6 h-6 mr-2"/>
                            Cheque
                        </x-tab.basic-title>
                        <x-tab.basic-title name="1" wire:click="selectType('cash')">
                            <x-icon name="cash" class="w-6 h-6 mr-2"/>
                            Cash/CDM
                        </x-tab.basic-title>
                        <x-tab.basic-title name="2" wire:click="selectType('ibt/si')">
                            <x-icon name="cash" class="w-6 h-6 mr-2"/>
                            IBT/SI
                        </x-tab.basic-title>
                    </x-card>
                </div>
                <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                    <div wire:loading wire:target="selectType">
                        @include('misc.loading')
                    </div>
                    <livewire:teller.payment-contribution.details :type="$type" />
                </div>
            </div>
        </div>
    </x-container>
</div>
