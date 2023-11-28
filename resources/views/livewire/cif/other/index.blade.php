
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Others Information" routeBackBtn="" titleBackBtn="" disableBackBtn="false">
        <div x-data="{ active: @entangle('setIndex') }" class="relative">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex flex-wrap justify-start sm:justify-start">
                    @foreach(config('module.other-info.tab.index') as $config)
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
                @foreach(config('module.other-info.tab.index') as $config)
                @php
                    $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                @endphp
                @if($setIndex == $config['index'])
                    @if($hasPermission)
                        @switch($setIndex)
                            @case('0')
                                <livewire:cif.info.finance :uuid="$uuid" />
                                @break
                            @case('1')
                                <livewire:cif.info.third-party-info :uuid="$uuid" />
                                @break
                            @case('2')
                                <livewire:cif.info.guarantee :uuid="$uuid" />
                                @break
                            @endswitch
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </x-container>
</div>


