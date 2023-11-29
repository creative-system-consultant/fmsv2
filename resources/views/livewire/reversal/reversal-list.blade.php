<div>
    <div wire:loading wire:target="type_payment_in,type_payment_out">
        @include('misc.loading')
    </div>
    <div x-data="{tab:@entangle('tabIndex')}">
        <x-container title="Reversal" routeBackBtn="" titleBackBtn="" disableBackBtn="">
            <div class="grid grid-cols-1">
                <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center ">
                        @foreach($list_tab as $item)
                        <x-tab.title name="{{$item['index']}}" wire:click="{{$item['wireClickFunction']}}">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="{{$item['icon']}}" class="w-5 h-5 mr-2"/>
                                <h1>{{$item['label']}}</h1>
                            </div>
                        </x-tab.title>
                        @endforeach
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
                                    <x-select.option label="{{ $item['value'] }}" value="{{ $item['value'] }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_financing == 'Disbursement')
                            <livewire:reversal.disbursement lazy />
                        @elseif($type_financing == 'Financing Repayment')
                            <livewire:reversal.financing-repayment lazy />
                        @elseif($type_financing == 'Early Settlement')
                            <livewire:reversal.early-settlement lazy />
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
                                    <x-select.option label="{{ $item['value'] }}" value="{{ $item['value'] }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_general == 'Share')
                            <livewire:reversal.share lazy />
                        @elseif($type_general == 'Contribution')
                            <livewire:reversal.contribution lazy />
                        @elseif($type_general == 'Other Payment')
                            <livewire:reversal.other-payment lazy />
                        @elseif($type_general == 'Miscellaneous')
                            <livewire:reversal.miscellaneous lazy />
                        @elseif($type_general == 'Third Party')
                            <livewire:reversal.third-party lazy />
                        @elseif($type_general == 'Dividend')
                            <livewire:reversal.dividend lazy />
                        @elseif($type_general == 'Refund Advance')
                            <livewire:reversal.refund-advance lazy />
                        @endif
                    </div>
                </div>
            </div>
        </x-container>
    </div>
</div>
