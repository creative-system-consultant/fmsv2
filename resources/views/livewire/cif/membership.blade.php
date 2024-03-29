<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Member Information" routeBackBtn="{{ route('cif.main') }}" titleBackBtn="member info" disableBackBtn="true">
        <div x-data="{ active:@entangle('setIndex')  }" class="relative">
            <div class="w-full bg-white border rounded-lg shadow-md  dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                <div class="flex items-center justify-between px-4 py-4 border-b dark:border-gray-700">
                    <h1 class="text-lg font-semibold dark:text-white">Category</h1>
                    <div class="flex items-center px-4 py-2 space-x-2 text-xs text-black bg-white border-2 border-black rounded-lg dark:border-gray-400 dark:text-white dark:bg-gray-800">
                        <x-icon name="user-circle" class="w-5 h-5"/>
                        <p>{{$name}}</p>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start sm:justify-start">
                    @foreach(config('module.member-info.member.index') as $config)
                        @php
                            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                        @endphp
                        @if($hasPermission)
                            <x-hovertab.title name="{{ $config['index'] }}" wire:click="setState({{ $config['index'] }})">
                                <x-icon name="{{ $config['icon'] }}" class="w-6 h-6 mr-2"/>
                                <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                                    {{ $config['name'] }}
                                </span>
                            </x-hovertab.title>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="mt-12">
                @foreach(config('module.member-info.member.index') as $config)
                @php
                    $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                @endphp
                @if($setIndex == $config['index'])
                    @if($hasPermission)
                        @switch($setIndex)
                            @case('0')
                                <livewire:cif.membership.mem-details :uuid="$uuid" />
                                @break
                            @case('1')
                                <livewire:cif.info.contribution :uuid="$uuid" />
                                @break
                            @case('2')
                                <livewire:cif.info.share :uuid="$uuid" />
                                @break
                            @case('3')
                                <livewire:cif.info.others-payment :uuid="$uuid" />
                                @break
                            @case('4')
                                <livewire:cif.info.monthly-payment-summary :uuid="$uuid" />
                                @break
                            @case('5')
                                <livewire:cif.info.dividend-statement :uuid="$uuid" />
                                @break
                            @case('6')
                                <livewire:cif.info.miscellaneous :uuid="$uuid" />
                                @break
                        @endswitch
                    @endif
                @endif
            @endforeach
            </div>
        </div>
    </x-container>
</div>
