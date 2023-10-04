<div>
    <x-container title="Refund Advance" routeBackBtn="{{route('teller.teller-refund-advance-list')}}" titleBackBtn="Refund Advance list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                    <div class="w-full md:w-96">
                        <x-input 
                            label="Name :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Account No :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Advance Amount :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-4  p-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
                <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                    <x-card title="Category">
                        <x-tab.basic-title name="0">
                            <x-icon name="user-circle" class="w-6 h-6 mr-2"/>
                            Pay to Members
                        </x-tab.basic-title>
                    </x-card>
                </div>
                <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                    <x-card title="Members">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-input 
                                label="Amount" 
                                wire:model=""
                            />

                            <x-input 
                                label="Transaction Date" 
                                type="date"
                                wire:model=""
                            />

                            <x-input 
                                label="Document No" 
                                wire:model=""
                                disabled
                            />

                            <x-native-select label="Bank Members"  wire:model="">
                                <option value=""></option>
                            </x-native-select>

                            <x-input 
                                label="Members Account No" 
                                wire:model=""
                            />

                            <x-native-select label="Bank Koputra"  wire:model="">
                                <option value=""></option>
                            </x-native-select>
                        </div>
                        <div class="grid grid-cols-1 gap-4 mt-4">
                            <x-textarea label="Remarks" wire:model="" />
                        </div>
                        <x-slot name="footer">
                            <div class="flex justify-end items-center">
                                <x-button 
                                    sm  
                                    icon="clipboard-check" 
                                    primary 
                                    label="Update Info" 
                                />
                            </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </x-container>
</div>

