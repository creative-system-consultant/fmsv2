<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Financing Info" routeBackBtn="" titleBackBtn="" disableBackBtn="false">

        <div x-data="{ active:0 }" class="relative">

            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex items-center justify-between px-4 py-4 border-b dark:border-gray-700">
                    <h1 class="font-semibold text-lg dark:text-white">Category</h1>
                </div>
                <div class="flex flex-wrap justify-start sm:justify-start">
                    <x-hovertab.title name="0" wire:click="setState(0)">
                        <x-icon name="calculator" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Pre Disbursement
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="1" wire:click="setState(1)">
                        <x-icon name="identification" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Active Account
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="2" wire:click="setState(2)">
                        <x-icon name="lock-closed" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Closed Account
                        </span>
                    </x-hovertab.title>
                </div>
            </div>

            <div class="mt-6">
                @if($setIndex == '2')
                    <livewire:finance.pre-disbursement.pre-disb-list />
                @elseif($setIndex  == '1')
                    <livewire:finance.active-account.active-account-list />
                @elseif($setIndex  == '0')
                    <livewire:finance.closed-account.closed-account-list />
                @endif
            </div>

        </div>
    </x-container>
</div>
