<div>
    <div class="container mx-auto mt-4" x-data="{tab:0}">
        <div class="grid grid-cols-1 px-6">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-7 lg:col-span-8 xxl:col-span-8">
                    <div class="bg-white/70 backdrop-blur-lg md:px-12 2xl:px-24 py-4  shadow-lg rounded-lg h-72 flex flex-col items-center justify-center border dark:bg-gray-900/50 dark:border-black">
                        <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-center dark:text-white">
                            <div class="space-y-2 flex flex-col">
                                <h1 class="text-3xl font-bold">
                                    Welcome to <span class="text-primary-500">FMS</span> Web
                                </h1>
                                <h4 class="text-gray-500 text-sm dark:text-white">
                                    Also known as “KOPERASI Financing Management” 
                                    Used to manage information of “KOPERASI members and their financing.
                                </h4>
                                <div class="pt-4">
                                    <x-button class="py-2" wire:navigate href="{{ route('cif.main') }}" icon="arrow-circle-right" primary label=" Go to Member Info" />
                                </div>
                            </div>
                            <div class="flex justify-center items-center -ml-6">
                                <img src="{{asset('herodashboard.png')}}" class="w-auto h-80"/>
                            </div>
                        </div>
                    </div>


                    <div class="bg-white dark:bg-gray-800 dark:border-black py-6 shadow-lg rounded-lg flex flex-col px-4 border mt-6 relative" >
                        <div class="bg-white rounded-lg shadow-sm mb-4 dark:bg-gray-900 flex">
                            <div class="flex items-center space-x-4">
                                <x-tab.title name="0">
                                    <div class="flex items-center spcae-x-2 text-sm">
                                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                        <h1>Disbursement Listing</h1>
                                    </div>
                                </x-tab.title>
                                <x-tab.title name="1">
                                    <div class="flex items-center spcae-x-2 text-sm">
                                        <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                        <h1>Pre Disbursement Listing</h1>
                                    </div>
                                </x-tab.title>
                            </div>
                        </div>
                        
                        <div x-show="tab == 0">
                            <div class="mt-2">
                                <div class="flex justify-start items-center mb-4">
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
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 py-3">
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
                                                <x-button onclick="$openModal('disb-modal')" sm icon="dots-horizontal" primary label="More info" />
                                            </x-table.table-body>
                                        </tr>
                                        @endforeach
                                    </x-slot>
                                </x-table.table>
                                <div class="mt-4">
                                    {{ $data->links('livewire::pagination-links') }}
                                </div>

                                <x-modal.card title="Disbursement" align="center" max-width="4xl" wire:model.defer="disb-modal">
                                    <div class="grid sm:grid-cols-2 gap-4">
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
                                <div class="flex justify-start items-center mb-4">
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
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 py-3">
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
                                                <x-button onclick="$openModal('predisb-modal')" sm icon="dots-horizontal" primary label="More info" />
                                            </x-table.table-body>
                                        </tr>
                                        @endforeach
                                    </x-slot>
                                </x-table.table>
                                <div class="mt-4">
                                    {{ $data->links('livewire::pagination-links') }}
                                </div>
                                    <x-modal.card title="Pre Disbursement" align="center" max-width="4xl" wire:model.defer="predisb-modal">
                                        <div class="grid sm:grid-cols-2 gap-4">
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


                <div class="col-span-12 sm:col-span-12 md:col-span-5 lg:col-span-4 xxl:col-span-4">
                    <div class="bg-white/70 dark:bg-gray-900/50 dark:border-black  dark:text-white backdrop-blur-lg p-4 shadow-lg rounded-lg h-72 flex flex-col items-center justify-center px-12 border">
                        <x-avatar size="w-24 h-24" class="border-primary-700 border-2" src="https://picsum.photos/300?size=lg" />
                        <h1 class="pt-2">
                            {{ auth()->user()->name }}
                        </h1>
                        <h1 class="pt-1 text-gray-500 text-sm dark:text-white"> 
                            {{ auth()->user()->email }}
                        </h1>
                        <div class="w-full mt-5">
                            <x-button class="py-3 w-full" wire:navigate href="{{route('profile')}}" outline black label="Edit Profile" />
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 dark:border-black dark:text-white py-6 shadow-lg rounded-lg flex flex-col px-4 border mt-6 relative">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="bg-gradient-to-r from-primary-500 to-cyan-400 rounded-full w-32 h-32 relative"
                                    :class="tab == 0 ? 'animate-spin' : ''">
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-full w-24 h-24 absolute  top-4 inset-x-0 mx-auto flex items-center justify-center">
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

                    <div class="dark:bg-gray-800 dark:text-white dark:border-black py-6 shadow-lg rounded-lg flex flex-col px-4 border mt-6">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="bg-gradient-to-r  from-cyan-400 to-primary-500 rounded-full w-32 h-32 relative"
                                :class="tab == 1 ? 'animate-spin' : ''">
                                </div>
                                <div class="bg-white  dark:bg-gray-800 rounded-full w-24 h-24 absolute  top-4 inset-x-0 mx-auto flex items-center justify-center">
                                    <h1 class="text-2xl font-semibold text-primary-500  dark:text-primary-200">56</h1>
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
