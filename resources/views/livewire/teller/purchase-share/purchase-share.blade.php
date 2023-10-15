<div>
    <div class="grid grid-cols-1">
        <livewire:general.customer-search :totalShare=true />

        <div class="grid grid-cols-12 gap-6 px-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                <x-card title="Category">
                    <x-tab.basic-title name="0" wire:click="selectType('cheque')">
                        <x-icon name="credit-card" class="w-6 h-6 mr-2"/>
                        Cheque
                    </x-tab.basic-title>
                    <x-tab.basic-title name="1" wire:click="selectType('cash')">
                        <x-icon name="cash" class="w-6 h-6 mr-2"/>
                        Cash/CDM
                    </x-tab.basic-title>
                    <x-tab.basic-title name="2" wire:click="selectType('SI')">
                        <x-icon name="cash" class="w-6 h-6 mr-2"/>
                        IBT/SI
                    </x-tab.basic-title>
                </x-card>
            </div>
            <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                <div wire:loading wire:target="selectType">
                    @include('misc.loading')
                </div>
                <x-card title="{{$type == 'cheque' ? 'Cheque' : ($type == 'cash' ? 'Cash' : 'IBT/SI') }} Details" >
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @if($type == 'cheque')
                            <x-input
                                label="Cheque Date"
                                type="date"
                                wire:model=""
                            />

                            <x-native-select label="Bank"  wire:model="">
                                <option value=""></option>
                            </x-native-select>
                        @endif

                        @if($type == 'cheque' || $type == 'cash' || $type == 'SI')
                            <x-native-select label="Bank Company"  wire:model="">
                                <option value=""></option>
                            </x-native-select>
                        @endif

                        <x-input
                            label="Document No"
                            wire:model=""
                        />

                        <x-input
                            label="Amount"
                            wire:model=""
                        />

                        <x-input
                            label="Transaction Date"
                            type="date"
                            wire:model=""
                        />

                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <x-textarea label="Remarks" wire:model="" />
                    </div>
                    <x-slot name="footer">
                        <div class="flex items-center justify-end">
                            <x-button
                                sm
                                icon="clipboard-check"
                                primary
                                label="Save"
                            />
                        </div>
                    </x-slot>
                </x-card>
            </div>
        </div>
    </div>
</div>
