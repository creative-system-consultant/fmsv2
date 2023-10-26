<div>
    <div wire:loading wire:target="type_payment_in,type_payment_out">
        @include('misc.loading')
    </div>
    <div x-data="{tab:0}">
        <x-container title="Reversal" routeBackBtn="" titleBackBtn="" disableBackBtn="">
            <div class="grid grid-cols-1">
                <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center ">
                        <x-tab.title name="0" wire:click="clearFinancing">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="currency-dollar" class="w-5 h-5 mr-2"/>
                                <h1>Financing</h1>
                            </div>
                        </x-tab.title>
                        <x-tab.title name="1" wire:click="clearGeneral">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="collection" class="w-5 h-5 mr-2"/>
                                <h1>General</h1>
                            </div>
                        </x-tab.title>
                    </div>
                </div>

                <!-- Financing -->
                <div x-show="tab == 0">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select
                                label="Type of Financing Reversal"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live="type_financing"
                            >
                                @foreach($option_financing as $item)
                                    <x-select.option label="{{ $item->value }}" value="{{  $item->value }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_financing == 'Disbursement')
                            <livewire:general.reversal.common-page/>
                        @elseif($type_financing == 'Financing Repayment')
                        
                        @elseif($type_financing == 'Early Settlement')

                        @endif
                    </div>
                </div>

                <!-- General -->
                <div x-show="tab == 1">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select
                                label="Type of General Reversal"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live="type_general"
                            >
                                @foreach($option_general as $item)
                                    <x-select.option label="{{ $item->value }}" value="{{  $item->value }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_general == 'Share')

                        @elseif($type_general == 'Contribution')

                        @elseif($type_general == 'Other Payment')

                        @elseif($type_general == 'Miscellaneous')

                        @elseif($type_general == 'Third Party')

                        @elseif($type_general == 'Dividend')

                        @elseif($type_general == 'Refund Advance')
                        
                        @endif
                    </div>
                </div>
            </div>
        </x-container>
    </div>
</div>
