<div>
    <div wire:loading wire:target="type_payment_in,type_payment_out">
        @include('misc.loading')
    </div>
    <div x-data="{tab:0}">
        <x-container title="Teller" routeBackBtn="" titleBackBtn="" disableBackBtn="">
            <div class="grid grid-cols-1">
                <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center ">
                        <x-tab.title name="0" >
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="login" class="w-5 h-5 mr-2"/>
                                <h1>Payment In</h1>
                            </div>
                        </x-tab.title>
                        <x-tab.title name="1">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="logout" class="w-5 h-5 mr-2"/>
                                <h1>Payment Out</h1>
                            </div>
                        </x-tab.title>
                    </div>
                </div>

                <!-- payment in -->
                <div x-show="tab == 0">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select label="Type of Payment In" placeholder="-- PLEASE SELECT --" minItemsForSearch="1" wire:model.live="type_payment_in">
                                @foreach($options['in'] as $item => $component)
                                    <x-select.option label="{{ $item }}" value="{{  $item }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if(array_key_exists($type_payment_in, $options['in']))
                            @livewire($options['in'][$type_payment_in], [], key($type_payment_in))
                        @endif
                    </div>
                </div>

                <!-- payment out -->
                <div x-show="tab == 1">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select label="Type of Payment Out" placeholder="-- PLEASE SELECT --" minItemsForSearch="1" wire:model.live="type_payment_out">
                                @foreach($options['out'] as $item => $component)
                                    <x-select.option label="{{ $item }}" value="{{  $item }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if(array_key_exists($type_payment_out, $options['out']))
                            @livewire($options['out'][$type_payment_out], [], key($type_payment_out))
                        @endif
                    </div>
                </div>
            </div>
        </x-container>
    </div>
</div>
