
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="FINANCING INFORMATION" routeBackBtn="{{route('finance.finance-financing-info')}}" titleBackBtn="financig Info list" disableBackBtn="true">
        <div x-data="{ active:0 }" class="relative">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex items-center justify-between px-4 py-4 border-b dark:border-gray-700">
                    <h1 class="font-semibold text-lg dark:text-white">Category</h1>
                    <div class="bg-white border-2 border-black dark:border-gray-400 dark:text-white dark:bg-gray-800 px-4 py-2 text-xs rounded-lg text-black flex space-x-2 items-center">
                        <x-icon name="user-circle" class="w-5 h-5"/>
                        <p>RAJA SAHRUL HISHAN BIN RAJA MAT</p>
                    </div>
                </div>
            
                <div class="flex flex-wrap justify-start sm:justify-start">

                    <x-hovertab.title name="0" wire:click="setState(0)">
                        <x-icon name="information-circle" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Account Master
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="1" wire:click="setState(1)">
                        <x-icon name="clipboard-list" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Account Position
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="2" wire:click="setState(2)">
                        <x-icon name="view-list" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Repayment Schedule
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="3" wire:click="setState(3)">
                        <x-icon name="collection" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Statements
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="4" wire:click="setState(4)">
                        <x-icon name="document-text" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Pre-Disbursement Conditions
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="5" wire:click="setState(5)">
                        <x-icon name="paper-airplane" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Early Settlement
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="6" wire:click="setState(6)">
                        <x-icon name="calendar" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Reschedule
                        </span>
                    </x-hovertab.title>
                </div>

            </div>

            <div class="mt-12">
                @if($setIndex == '0')
                    <livewire:finance.category.info.account-master />
                @elseif($setIndex  == '1')
                    <livewire:finance.category.info.account-position />
                @elseif($setIndex  == '2')
                    <livewire:finance.category.info.repayment-schedule />
                @elseif($setIndex  == '3')
                    <livewire:finance.category.info.statement />
                @elseif($setIndex  == '4')
                    <livewire:finance.category.info.pre-disb-condition />
                @elseif($setIndex  == '5')
                    <livewire:finance.category.info.early-settlement />
                @elseif($setIndex  == '6')
                    <livewire:finance.category.info.reschedule />
                @endif
            </div>
        </div>
    </x-container>
</div>


