<div>
    {{-- modal to select client --}}
    <x-modal.card title="Select Client Account" align="center" blur wire:model.defer="selectClientModal" max-width="lg" hide-close="true">
        <div class="gap-4 my-2">
            <x-select
                label="Clients"
                placeholder="-- PLEASE SELECT --"
                wire:model="client"
            >

                @foreach ($clients as $client)
                    <x-select.option label="{{ strtoupper($client->name) }}" value="{{ $client->id }}" />
                @endforeach
            </x-select>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button primary label="Save" wire:click="saveClient" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    {{-- end modal select client --}}

    <div class="container mx-auto mt-4" x-data="{tab:0}">
        <div class="grid grid-cols-1 px-4 mb-20 sm:px-6 xl:mb-0">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 xl:col-span-8 2xl:col-span-8">
                    <div class="flex flex-col items-center justify-center px-6 py-8 border rounded-lg shadow-lg bg-white/70 backdrop-blur-lg md:px-12 2xl:px-24 sm:py-4 sm:h-72 dark:bg-gray-900/50 dark:border-black">
                        <div class="grid items-center justify-center grid-cols-1 md:grid-cols-2 dark:text-white">
                            <div class="flex flex-col order-last space-y-2 sm:order-first">
                                <h1 class="text-3xl font-bold text-center sm:text-left">
                                    Welcome to <span class="text-primary-500">FMS</span> Web
                                </h1>
                                <h4 class="text-sm leading-6 text-center text-gray-500 dark:text-white sm:text-left">
                                    Your dedicated management system for '{{ auth()->user()->refClient->name }}.'
                                    This sophisticated platform is designed to streamline the organization and retrieval of information pertaining to
                                    '{{ auth()->user()->refClient->name }},' ensuring that staff can efficiently access and manage their
                                    @if(auth()->user()->refClient->clientType->description == 'COOP')
                                        Cooperative's
                                    @elseif(auth()->user()->refClient->clientType->description == 'CLUB')
                                        Club's
                                    @elseif(auth()->user()->refClient->clientType->description == 'BANK')
                                        Bank
                                    @elseif(auth()->user()->refClient->clientType->description == 'ARRAHNU')
                                        Arrahnu
                                    @elseif(auth()->user()->refClient->clientType->description == 'JMB')
                                        Joint Management Body
                                    @elseif(auth()->user()->refClient->clientType->description == 'ASSOCIATION')
                                        Association's
                                    @endif
                                    data.
                                </h4>
                            </div>
                            <div class="flex items-center justify-center ml-0 sm:-ml-2">
                                <img src="{{asset('herodashboard.png')}}" class="w-auto h-64 sm:h-64" alt="Hero"/>
                            </div>
                        </div>
                    </div>
                    <div class="relative flex flex-col px-4 py-6 mt-6 mb-20 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-black" >
                        @if (auth()->user()->user_type != 2)
                            <div>
                                <div class="flex mb-4 overflow-x-auto overflow-y-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
                                        <div class="flex items-center flex-shrink-0 space-x-4 ">
                                            <x-tab.title name="0">
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                                    @if($clientType == 'siskop membership financing')
                                                        <h1>Disbursement Listing</h1>
                                                    @else
                                                        <h1>Active Membership</h1>
                                                    @endif
                                                </div>
                                            </x-tab.title>
                                            <x-tab.title name="1">
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                                    @if($clientType == 'siskop membership financing')
                                                        <h1>Pre Disbursement Listing</h1>
                                                    @else
                                                        <h1>Closed Membership</h1>
                                                    @endif
                                                </div>
                                            </x-tab.title>
                                        </div>
                                </div>
                                <div x-show="tab == 0">
                                    <div class="mt-2">
                                        <div class="flex items-center justify-start mb-4">
                                            <x-input
                                                wire:model=""
                                                placeholder="Search"
                                            />
                                        </div>
                                        @if($clientType == 'siskop membership financing')
                                            <x-table.table>
                                                <x-slot name="thead">
                                                    <x-table.table-header class="text-left" value="NO" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                                    <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @forelse($disb as $item)
                                                    <tr>
                                                        <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                            {{ $loop->iteration }}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->name}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->ACCOUNT_NO}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->mbr_no}}
                                                        </x-table.table-body>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                            <x-no-data title="No data"/>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @endforelse
                                                </x-slot>
                                            </x-table.table>
                                            <div class="mt-4">
                                                {{ $disb->links('livewire::pagination-links') }}
                                            </div>
                                        @else
                                            <x-table.table>
                                                <x-slot name="thead">
                                                    <x-table.table-header class="text-left" value="NO" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                                    <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @forelse($activeMember as $item)
                                                    <tr>
                                                        <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                            {{ $loop->iteration }}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->cifCustomer->name}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->cifCustomer->identity_no}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->mbr_no}}
                                                        </x-table.table-body>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                            <x-no-data title="No data"/>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @endforelse
                                                </x-slot>
                                            </x-table.table>
                                            <div class="mt-4">
                                                {{ $activeMember->links('livewire::pagination-links') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div x-show="tab == 1">
                                    <div class="mt-2">
                                        <div class="flex items-center justify-start mb-4">
                                            <x-input
                                                wire:model=""
                                                placeholder="Search"
                                            />
                                        </div>
                                        @if($clientType == 'siskop membership financing')
                                            <x-table.table>
                                                <x-slot name="thead">
                                                    <x-table.table-header class="text-left" value="NO" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                                    <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @forelse($preDisb as $item)
                                                    <tr>
                                                        <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                            {{ $loop->iteration }}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->name}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->ACCOUNT_NO}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->mbr_no}}
                                                        </x-table.table-body>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                            <x-no-data title="No data"/>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @endforelse
                                                </x-slot>
                                            </x-table.table>
                                            <div class="mt-4">
                                                {{ $preDisb->links('livewire::pagination-links') }}
                                            </div>
                                        @else
                                            <x-table.table>
                                                <x-slot name="thead">
                                                    <x-table.table-header class="text-left" value="NO" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                                    <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                                                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @forelse($closeMember as $item)
                                                    <tr>
                                                        <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                            {{ $loop->iteration }}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->cifCustomer->name}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->cifCustomer->identity_no}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->mbr_no}}
                                                        </x-table.table-body>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                            <x-no-data title="No data"/>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @endforelse
                                                </x-slot>
                                            </x-table.table>
                                            <div class="mt-4">
                                                {{ $closeMember->links('livewire::pagination-links') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="flex mb-4 overflow-x-auto overflow-y-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
                                    <div class="flex items-center flex-shrink-0 space-x-4 ">
                                        <x-tab.title name="0">
                                            <div class="flex items-center space-x-2 text-sm">
                                                <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                                <h1>List Of User</h1>
                                            </div>
                                        </x-tab.title>
                                    </div>
                                </div>
                                <div class="flex items-center justify-start mb-4">
                                    <x-input
                                        wire:model=""
                                        placeholder="Search"
                                    />
                                </div>
                                @if(auth()->user()->client_id == 4)
                                    <x-table.table>
                                        <x-slot name="thead">
                                            <x-table.table-header class="text-left" value="NO" sort="" />
                                            <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                            <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                                            <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                        </x-slot>
                                        <x-slot name="tbody">
                                            <tr>
                                                <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                    1
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    Dato Mus
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    420376509687
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    45325
                                                </x-table.table-body>
                                            </tr>
                                            <tr>
                                                <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                    2
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    Fattah
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    772811431698
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    24582
                                                </x-table.table-body>
                                            </tr>
                                        </x-slot>
                                    </x-table.table>
                                @else
                                    <x-table.table>
                                        <x-slot name="thead">
                                            <x-table.table-header class="text-left" value="NO" sort="" />
                                            <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                            <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                                            <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                                        </x-slot>
                                        <x-slot name="tbody">
                                            <tr>
                                                <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                    1
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    Dato Mus
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    420376509687
                                                </x-table.table-body>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    45325
                                                </x-table.table-body>
                                            </tr>
                                        </x-slot>
                                    </x-table.table>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>


                <div class="col-span-12 sm:col-span-12 md:col-span-12 xl:col-span-4 2xl:col-span-4">
                    <div class="hidden xl:block">
                        <div class="flex flex-col items-center justify-center p-4 px-12 border rounded-lg shadow-lg bg-white/70 dark:bg-gray-900/50 dark:border-black dark:text-white backdrop-blur-lg h-72">
                            @php 
                                if(auth()->user()->client_id == 4 && auth()->user()->user_type == 2) {
                                    $img = 'https://www.maybank.com/iwov-resources/images/pages/about-us/leadership/leadership_detail/03-Dato-Muzaffar-Hisham.png';
                                }elseif(auth()->user()->client_id == 5  && auth()->user()->user_type == 2){
                                    $img = 'https://roadcare.com.my/wp-content/uploads/2022/11/EN-YASIR-08-200x283.png';
                                }else{
                                    $img = 'https://www.nicepng.com/png/detail/128-1280406_view-user-icon-png-user-circle-icon-png.png';
                                }
                            @endphp
                            <x-avatar size="w-24 h-24" class="border-2 border-primary-700" src={{$img}} />
                            <h1 class="pt-2">
                                {{ auth()->user()->name }}
                            </h1>
                            <h1 class="pt-1 text-sm text-gray-500 dark:text-white">
                                {{ auth()->user()->email }}
                            </h1>
                            <div class="w-full mt-5">
                                <x-button class="w-full py-3" href="{{route('profile')}}" outline black label="Edit Profile" />
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->user_type != 2)
                    <div class="grid grid-cols-1 gap-2 md:grid-cols-2 xl:grid-cols-1">
                        <div class="relative flex flex-col px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-black dark:text-white">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-primary-500 to-primary-600"
                                        :class="tab == 0 ? 'animate-spin' : ''">
                                    </div>
                                    <div class="absolute inset-x-0 flex items-center justify-center w-24 h-24 mx-auto bg-white rounded-full dark:bg-gray-800 top-4">
                                        @if($clientType == 'siskop membership financing')
                                            <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">{{ number_format($disb->total()) }}</h1>
                                        @else
                                            <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">{{ number_format($activeMember->total()) }}</h1>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="space-y-1 text-xl">
                                        @if($clientType == 'siskop membership financing')
                                            <h1>Disbursement Listing</h1>
                                        @else
                                            <h1>Active Membership</h1>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col px-4 py-6 mt-6 border rounded-lg shadow-lg dark:bg-gray-800 dark:text-white dark:border-black">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-primary-600 to-primary-500"
                                    :class="tab == 1 ? 'animate-spin' : ''">
                                    </div>
                                    <div class="absolute inset-x-0 flex items-center justify-center w-24 h-24 mx-auto bg-white rounded-full dark:bg-gray-800 top-4">
                                        @if($clientType == 'siskop membership financing')
                                            <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">{{ number_format($preDisb->total()) }}</h1>
                                        @else
                                            <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">{{ number_format($closeMember->total()) }}</h1>
                                        @endif
                                    </div>
                                </div>
                                <div class="space-y-1 text-xl">
                                    @if($clientType == 'siskop membership financing')
                                        <h1>Pre Disbursement Listing</h1>
                                    @else
                                        <h1>Close Membership</h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        @if(auth()->user()->client_id == 4)
                            <div class="flex flex-col px-4 py-6 mt-6 border rounded-lg shadow-lg bg-white dark:bg-gray-800 dark:text-white dark:border-black">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-primary-600 to-primary-500"
                                        :class="tab == 0 ? 'animate-spin' : ''">
                                        </div>
                                        <div class="absolute inset-x-0 flex items-center justify-center w-24 h-24 mx-auto bg-white rounded-full dark:bg-gray-800 top-4">
                                            <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">2</h1>
                                        </div>
                                    </div>
                                    <div class="space-y-1 text-xl">
                                        <h1>List Of User</h1>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col px-4 py-6 mt-6 border rounded-lg shadow-lg bg-white dark:bg-gray-800 dark:text-white dark:border-black">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-primary-600 to-primary-500"
                                        :class="tab == 0 ? 'animate-spin' : ''">
                                        </div>
                                        <div class="absolute inset-x-0 flex items-center justify-center w-24 h-24 mx-auto bg-white rounded-full dark:bg-gray-800 top-4">
                                            <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">1</h1>
                                        </div>
                                    </div>
                                    <div class="space-y-1 text-xl">
                                        <h1>List Of User</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
