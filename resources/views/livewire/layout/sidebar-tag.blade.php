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
        class="flex flex-col mt-4">
        <div class=" bg-gradient-to-r from-primary-400 via-primary-500 to-primary-400 px-2 py-3 text-white">
            <div class="flex items-start space-x-2 justify-center">
                <div class="text-sm space-y-1 text-center ">
                    <p class="font-semibold">{{ strtoupper(auth()->user()->refClient->name) }}</p>
                    @if(auth()->user()->user_type == 3)
                        <p class="text-xs">{{ strtoupper(auth()->user()->roles->where('client_id',auth()->user()->client_id )->first()->name) }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- mini sidebar -->
    <div
        x-show="toggleMiniSidebar"
        x-bind:class="openHoverMiniSidebar ? 'block' : 'hidden'"
        class="flex flex-col mt-4">
        <div class=" bg-gradient-to-r from-primary-400 via-primary-500 to-primary-400 px-2 py-3 text-white">
            <div class="flex items-start space-x-2 justify-center">
                <div class="text-sm space-y-0.5 text-center ">
                    <p class="font-semibold">{{ strtoupper(auth()->user()->refClient->name) }}</p>
                    @if(auth()->user()->user_type == 3)
                        <p class="text-xs">{{ strtoupper(auth()->user()->roles->where('client_id',auth()->user()->client_id )->first()->name) }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>