
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <div x-data="{ tab:0 }" class="relative">
        <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
            <div class="flex flex-wrap justify-start sm:justify-start">
                <x-tab.title name="0" wire:click="setState(0)">
                    <div class="flex items-center spcae-x-2 text-sm">
                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                        <h1>Special Aid</h1>
                    </div>
                </x-tab.title>

                {{-- <x-tab.title name="1" wire:click="setState(1)">
                    <div class="flex items-center spcae-x-2 text-sm">
                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                        <h1>Tabung Khairat</h1>
                    </div>
                </x-tab.title> --}}

                <x-tab.title name="2" wire:click="setState(2)">
                    <div class="flex items-center spcae-x-2 text-sm">
                        <x-icon name="user" class="w-5 h-5 mr-2"/>
                        <h1>Introducer</h1>
                    </div>
                </x-tab.title>

            </div>
        </div>

        <div class="mt-8">
            @if($setIndex == '0')
                <livewire:teller.payment-member.category.tabung-khairat />
            {{-- @elseif($setIndex  == '1')
                <livewire:teller.payment-member.category.tabung-kebajikan /> --}}
            @elseif($setIndex  == '2')
                <livewire:teller.payment-member.category.introducer />
            @endif
        </div>
    </div>
</div>


