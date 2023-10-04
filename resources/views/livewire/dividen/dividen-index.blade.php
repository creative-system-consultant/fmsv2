<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Dividen" routeBackBtn="" titleBackBtn="" disableBackBtn="false">
        <div x-data="{ tab:0 }" class="relative">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex flex-wrap justify-start sm:justify-start">
                    <x-tab.title name="0" wire:click="setState(0)">
                        <div class="flex items-center spcae-x-2 text-sm">
                            <x-icon name="presentation-chart-bar" class="w-5 h-5 mr-2"/>
                            <h1>Share & Contribution</h1>
                        </div>
                    </x-tab.title>

                    <x-tab.title name="1" wire:click="setState(1)">
                        <div class="flex items-center spcae-x-2 text-sm">
                            <x-icon name="presentation-chart-line" class="w-5 h-5 mr-2"/>
                            <h1>Share Bonus</h1>
                        </div>
                    </x-tab.title>
                </div>
            </div>

            <div class="mt-8">
                @if($setIndex == '0')
                    <livewire:dividen.share-contribution/>
                @elseif($setIndex  == '1')
                    <livewire:dividen.share-bonus/>
                @endif
            </div>
        </div>
    </x-container>
</div>