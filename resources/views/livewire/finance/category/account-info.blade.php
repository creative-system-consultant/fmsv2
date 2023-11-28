
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="FINANCING INFORMATION" routeBackBtn="{{route('finance.finance-financing-info')}}" titleBackBtn="financig Info list" disableBackBtn="true">
        <div x-data="{ active:0 }" class="relative">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex items-center justify-between px-4 py-4 border-b dark:border-gray-700">
                    <h1 class="font-semibold text-lg dark:text-white">Category</h1>
                    <div class="bg-white border-2 border-black dark:border-gray-400 dark:text-white dark:bg-gray-800 px-4 py-2 text-xs rounded-lg text-black flex space-x-2 items-center">
                        <x-icon name="user-circle" class="w-5 h-5"/>
                        <p>{{$customer}}</p>
                    </div>
                </div>
            
                <div class="flex flex-wrap justify-start sm:justify-start">
                    @foreach(config('module.financing-info.account-info.index') as $config)
                        @php
                            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                        @endphp
                        @if($hasPermission)
                            <x-hovertab.title name="{{ $config['index'] }}" wire:click="setState({{ $config['index'] }})">
                                <x-icon name="{{ $config['icon'] }}" class="w-6 h-6 mr-2"/>
                                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                    {{ $config['name'] }}
                                </span>
                            </x-hovertab.title>
                        @endif
                    @endforeach
                </div>

            </div>

            <div class="mt-12">
                @if($setIndex == '0')
                    <livewire:finance.category.info.account-master :uuid="$uuid"/>
                @elseif($setIndex  == '1')
                    <livewire:finance.category.info.account-position :uuid="$uuid"/>
                @elseif($setIndex  == '2')
                    <livewire:finance.category.info.repayment-schedule :uuid="$uuid" />
                @elseif($setIndex  == '3')
                    <livewire:finance.category.info.statement :uuid="$uuid"/>
                @elseif($setIndex  == '4')
                    <livewire:finance.category.info.pre-disb-condition :uuid="$uuid"/>
                @elseif($setIndex  == '5')
                    <livewire:finance.category.info.early-settlement :uuid="$uuid"/>
                @elseif($setIndex  == '6')
                    <livewire:finance.category.info.reschedule :uuid="$uuid"/>
                @endif

                @foreach(config('module.financing-info.account-info.index') as $config)
                    @php
                        $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                    @endphp
                    @if($setIndex == $config['index'])
                        @if($hasPermission)
                            @switch($setIndex)
                                @case('0')
                                    <livewire:finance.category.info.account-master :uuid="$uuid"/>
                                    @break
                                @case('1')
                                    <livewire:finance.category.info.account-position :uuid="$uuid"/>
                                    @break
                                @case('2')
                                    <livewire:finance.category.info.repayment-schedule :uuid="$uuid" />
                                    @break
                                @case('3')
                                    <livewire:finance.category.info.statement :uuid="$uuid"/>
                                    @break
                                @case('4')
                                    <livewire:finance.category.info.pre-disb-condition :uuid="$uuid"/>
                                    @break
                                @case('5')
                                    <livewire:finance.category.info.early-settlement :uuid="$uuid"/>
                                    @break
                                @case('6')
                                    <livewire:finance.category.info.reschedule :uuid="$uuid"/>
                                    @break
                            @endswitch
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </x-container>
</div>


