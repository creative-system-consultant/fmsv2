
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Others Information" routeBackBtn="" titleBackBtn="" disableBackBtn="false">
        <div x-data="{ active:0 }" class="relative">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex flex-wrap justify-start sm:justify-start">
                    <x-hovertab.title name="0" wire:click="setState(0)">
                        <x-icon name="currency-dollar" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Finance
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="1" wire:click="setState(1)">
                        <x-icon name="information-circle" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Third Party Info
                        </span>
                    </x-hovertab.title>

                    <x-hovertab.title name="2" wire:click="setState(2)">
                        <x-icon name="shield-check" class="w-6 h-6 mr-2"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Guarantee/Guarantor
                        </span>
                    </x-hovertab.title>
                </div>

            </div>

            <div class="mt-12">
                @if($setIndex  == '0')
                    <livewire:cif.info.finance :uuid="$uuid" />
                @elseif($setIndex  == '1')
                    <livewire:cif.info.third-party-info :uuid="$uuid" />
                @elseif($setIndex  == '2')
                <livewire:cif.info.guarantee :uuid="$uuid" />
                @endif
            </div>
        </div>
    </x-container>
</div>


