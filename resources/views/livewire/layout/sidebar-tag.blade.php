<div>
    <a href="{{ route('home') }}" class="flex items-center justify-center pt-4 text-xl font-bold">
        <div x-show="!toggleMiniSidebar">
            <img src="{{ asset('storage/' . auth()->user()->refClient->logo_path) }}" class="w-auto h-12" alt="Logo" />
        </div>
        <div x-show="toggleMiniSidebar">
            <img src="{{ asset('storage/' . auth()->user()->refClient->logo_path) }}" class="w-auto h-12" alt="Logo" x-bind:class="openHoverMiniSidebar ? 'lg:h-12' : 'lg:h-6'" />
        </div>
    </a>

    <!-- expanded sidebar -->
    <div
        x-show="!toggleMiniSidebar"
        class="flex flex-col items-center px-4 mt-6">
        <x-badge
            outline
            secondary
            label="{{ strtoupper(auth()->user()->refClient->name) }}"
            class="py-1"
            >
            <x-slot name="prepend" class="relative flex items-start w-2 h-2 mr-1">
                <span class="absolute inline-flex w-full h-full rounded-full bg-green-500/75 animate-ping"></span>
                <span class="relative inline-flex w-2 h-2 bg-green-500 rounded-full"></span>
            </x-slot>
        </x-badge>
    </div>

    <!-- mini sidebar -->
    <div
        x-show="toggleMiniSidebar"
        x-bind:class="openHoverMiniSidebar ? 'block' : 'hidden'"
        class="flex flex-col items-center mt-6">
        <x-badge
            outline
            secondary
            label="{{ strtoupper(auth()->user()->refClient->name) }}"
            class="py-1"
            >
            <x-slot name="prepend" class="relative flex items-center w-2 h-2 mr-1">
                <span class="absolute inline-flex w-full h-full rounded-full bg-green-500/75 animate-ping"></span>
                <span class="relative inline-flex w-2 h-2 bg-green-500 rounded-full"></span>
            </x-slot>
        </x-badge>
    </div>
</div>