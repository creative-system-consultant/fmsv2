
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Member Information" routeBackBtn="{{ route('cif.main') }}" titleBackBtn="member info" disableBackBtn="true">
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
                        <x-icon name="user-circle" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Details
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="1" wire:click="setState(1)">
                        <x-icon name="home" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Address
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="2" wire:click="setState(2)">
                        <x-icon name="user-group" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Beneficiary
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="3" wire:click="setState(3)">
                        <x-icon name="cash" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Contribution
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="4" wire:click="setState(4)">
                        <x-icon name="presentation-chart-line" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Share
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="5" wire:click="setState(5)">
                        <x-icon name="currency-dollar" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Finance
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="6" wire:click="setState(6)">
                        <x-icon name="information-circle" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Third Party Info
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="7" wire:click="setState(7)">
                        <x-icon name="shield-check" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Guarantee/Guarantor
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="8" wire:click="setState(8)">
                        <x-icon name="credit-card" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Others Payment
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="9" wire:click="setState(9)">
                        <x-icon name="calendar" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Monthly Payment Summary
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="10" wire:click="setState(10)">
                        <x-icon name="clipboard-list" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Dividend Statements
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="11" wire:click="setState(11)">
                        <x-icon name="inbox" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Miscellaneous
                        </span>
                    </x-hovertab.title>

                </div>

            </div>

            <div class="mt-12">
                @if($setIndex == '1')
                    <livewire:cif.info.details :uuid="$uuid" />
                @elseif($setIndex  == '0')
                    <livewire:cif.info.address :uuid="$uuid" />
                @elseif($setIndex  == '2')
                    <livewire:cif.info.beneficiary :uuid="$uuid" />
                @elseif($setIndex  == '3')
                    <livewire:cif.info.contribution :uuid="$uuid" />
                @elseif($setIndex  == '4')
                    <livewire:cif.info.share :uuid="$uuid" />
                @elseif($setIndex  == '5')
                    <livewire:cif.info.finance :uuid="$uuid" />
                @elseif($setIndex  == '6')
                    <livewire:cif.info.third-party-info :uuid="$uuid" />
                @elseif($setIndex  == '7')
                    <livewire:cif.info.guarantee :uuid="$uuid" />
                @elseif($setIndex  == '8')
                    <livewire:cif.info.others-payment :uuid="$uuid" />
                @elseif($setIndex  == '9')
                    <livewire:cif.info.monthly-payment-summary :uuid="$uuid" />
                @elseif($setIndex  == '10')
                    <livewire:cif.info.dividend-statement :uuid="$uuid" />
                @elseif($setIndex  == '11')
                    <livewire:cif.info.miscellaneous :uuid="$uuid" />
                @endif
            </div>
        </div>
    </x-container>
</div>


