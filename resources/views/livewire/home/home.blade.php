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
                                <h4 class="text-sm text-center text-gray-500 dark:text-white sm:text-left">
                                    Also known as “KOPERASI Financing Management”
                                    Used to manage information of “KOPERASI members and their financing.
                                </h4>
                                <div class="pt-4">
                                    <x-button class="w-full py-2 sm:w-fit" wire:navigate href="{{ route('cif.main') }}" icon="arrow-circle-right" primary label=" Go to Member Info" />
                                </div>
                            </div>
                            <div class="flex items-center justify-center ml-0 sm:-ml-6">
                                <img src="{{asset('herodashboard.png')}}" class="w-auto h-64 sm:h-80" alt="Hero"/>
                            </div>
                        </div>
                    </div>



                        <div class="relative flex flex-col px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-black" >
                            <div class="flex mb-4 overflow-x-auto overflow-y-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
                                <div class="flex items-center flex-shrink-0 space-x-4 ">
                                    <x-tab.title name="0">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                            <h1>Disbursement Listing</h1>
                                        </div>
                                    </x-tab.title>
                                    <x-tab.title name="1">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                            <h1>Pre Disbursement Listing</h1>
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
                                    <x-table.table>
                                        <x-slot name="thead">
                                            <x-table.table-header class="text-left" value="NO" sort="" />
                                            <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                            <x-table.table-header class="text-left" value="IDENTITY NUMBER" sort="" />
                                            <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                                            <x-table.table-header class="text-left" value="ACTION" sort="" />
                                        </x-slot>
                                        <x-slot name="tbody">
                                            @foreach($data as $item)
                                            <tr>
                                                <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                    1
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    NOR ZAHARA BINTI MOHD ISA
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    700210055198
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    700210055198
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    <x-button onclick="$openModal('disb-modal')" xs icon="dots-horizontal" primary label="More info" />
                                                </x-table.table-body>
                                            </tr>
                                            @endforeach
                                        </x-slot>
                                    </x-table.table>
                                    <div class="mt-4">
                                        {{ $data->links('livewire::pagination-links') }}
                                    </div>

                                    <x-modal.card title="Disbursement" align="center" max-width="4xl" wire:model.defer="disb-modal">
                                        <div class="grid gap-4 sm:grid-cols-2">
                                            <x-input label="MEMBER NAME" disabled value="" />
                                            <x-input label="IDENTITY NUMBER" disabled value="" />
                                            <x-input label="ACCOUNT NO" disabled value="" />
                                            <x-input label="PRODUCTS" disabled value="" />
                                            <x-input label="PRODUCTS DETAIL" disabled value="" />
                                            <x-input label="APPROVED AMOUNT" disabled value="" />
                                        </div>

                                        <x-slot name="footer">
                                            <div class="flex justify-end gap-x-4">
                                                <div class="flex">
                                                    <x-button flat label="Cancel" x-on:click="close" />
                                                    <x-button primary label="Things To-do" wire:click="" />
                                                </div>
                                            </div>
                                        </x-slot>
                                    </x-modal.card>
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
                                    <x-table.table>
                                        <x-slot name="thead">
                                            <x-table.table-header class="text-left" value="NO" sort="" />
                                            <x-table.table-header class="text-left" value="MEMBER NAME" sort="" />
                                            <x-table.table-header class="text-left" value="IDENTITY NUMBER" sort="" />
                                            <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                                            <x-table.table-header class="text-left" value="ACTION" sort="" />
                                        </x-slot>
                                        <x-slot name="tbody">
                                            @foreach($data as $item)
                                            <tr>
                                                <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                    1
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    NOR ZAHARA BINTI MOHD ISA
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    700210055198
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    700210055198
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    <x-button onclick="$openModal('predisb-modal')" xs icon="dots-horizontal" primary label="More info" />
                                                </x-table.table-body>
                                            </tr>
                                            @endforeach
                                        </x-slot>
                                    </x-table.table>
                                    <div class="mt-4">
                                        {{ $data->links('livewire::pagination-links') }}
                                    </div>
                                        <x-modal.card title="Pre Disbursement" align="center" max-width="4xl" wire:model.defer="predisb-modal">
                                            <div class="grid gap-4 sm:grid-cols-2">
                                                <x-input label="NAME" disabled value="" />
                                                <x-input label="MEMBER ID" disabled value="" />
                                                <x-input label="ACCOUNT NO" disabled value="" />
                                                <x-input label="IDENTITY NO" disabled value="" />
                                                <x-input label="PRODUCTS" disabled value="" />
                                                <x-input label="PRODUCTS DETAIL" disabled value="" />
                                                <x-input label="APPROVED LIMIT" disabled value="" />
                                                <x-input label="INSTALLMENT AMOUNT" disabled value="" />
                                                <x-input label="APPROVED DATE" disabled value="" />
                                            </div>

                                            <x-slot name="footer">
                                                <div class="flex justify-end gap-x-4">
                                                    <div class="flex">
                                                        <x-button flat label="Cancel" x-on:click="close" />
                                                        <x-button primary label="Things To-do" wire:click="" />
                                                    </div>
                                                </div>
                                            </x-slot>
                                        </x-modal.card>
                                </div>
                            </div>
                        </div>

                </div>


                <div class="col-span-12 sm:col-span-12 md:col-span-12 xl:col-span-4 2xl:col-span-4">

                    <div class="hidden xl:block">
                        <div class="flex flex-col items-center justify-center p-4 px-12 border rounded-lg shadow-lg bg-white/70 dark:bg-gray-900/50 dark:border-black dark:text-white backdrop-blur-lg h-72">
                            <x-avatar size="w-24 h-24" class="border-2 border-primary-700" src="https://picsum.photos/300?size=lg" />
                            <h1 class="pt-2">
                                {{ auth()->user()->name }}
                            </h1>
                            <h1 class="pt-1 text-sm text-gray-500 dark:text-white">
                                {{ auth()->user()->email }}
                            </h1>
                            <div class="w-full mt-5">
                                <x-button class="w-full py-3" wire:navigate href="{{route('profile')}}" outline black label="Edit Profile" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-2 md:grid-cols-2 xl:grid-cols-1">
                        <div class="relative flex flex-col px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-black dark:text-white">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-primary-500 to-cyan-400"
                                        :class="tab == 0 ? 'animate-spin' : ''">
                                    </div>
                                    <div class="absolute inset-x-0 flex items-center justify-center w-24 h-24 mx-auto bg-white rounded-full dark:bg-gray-800 top-4">
                                        <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">84</h1>
                                    </div>
                                </div>
                                <div>
                                    <div class="space-y-1 text-xl">
                                        <h1>Disbursement Listing</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col px-4 py-6 mt-6 border rounded-lg shadow-lg dark:bg-gray-800 dark:text-white dark:border-black">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-cyan-400 to-primary-500"
                                    :class="tab == 1 ? 'animate-spin' : ''">
                                    </div>
                                    <div class="absolute inset-x-0 flex items-center justify-center w-24 h-24 mx-auto bg-white rounded-full dark:bg-gray-800 top-4">
                                        <h1 class="text-2xl font-semibold text-primary-500 dark:text-primary-200">56</h1>
                                    </div>
                                </div>
                                <div class="space-y-1 text-xl">
                                    <h1>Pre Disbursement Listing</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
