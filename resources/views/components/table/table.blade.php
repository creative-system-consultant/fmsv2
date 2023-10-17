
@props([
    'loading' => '',
    'loadingtarget' => '',
])
<style>
    table, td, th {
        white-space: nowrap;
    }
</style>
<div class="relative z-0 flex flex-col">
    <div class="-my-2 overflow-x-auto ">
        <div class="inline-block min-w-full py-2 align-middle">
            <div class="overflow-hidden bg-white border border-gray-200 shadow sm:rounded-lg dark:bg-gray-900 dark:border-gray-600 ">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="relative">
                        <tr>
                            {{ $thead }}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600">
                        {{ $tbody }}
                        <tr>
                            @if($loading == 'true')
                                <div wire:loading wire:target="{{$loadingtarget}}">
                                    <div class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 backdrop-blur-lg z-50">
                                        <div class="flex flex-col items-center justify-center h-full ">
                                            <svg class="h-10 w-10 text-primary-600 dark:text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <p class="text-primary-600 dark:text-white text-sm mt-2 text-center ml-3">Loading...</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
