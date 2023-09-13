
@extends('layouts.base')
@section('body')
<div>
    <div class="absolute top-0 right-0 p-4 ">
        <x-toggle-theme/>
    </div>
    <div class="container min-h-screen px-6 py-12 mx-auto md:px-24 lg:flex lg:items-center lg:gap-12">
        <div class="w-full lg:w-1/2">
            <p class="text-3xl font-semibold md:text-4xl text-primary-500 dark:text-primary-400">@yield('code') error
            </p>
            <h1 class="mt-3 text-2xl text-gray-800 dark:text-white md:text-2xl">Page @yield('message')</h1>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Sorry, @yield('description') Here are some helpful
                links:</p>
            <div class="flex items-center mt-6 gap-x-3">
                <a href="{{ url()->previous() }}"
                    class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 rtl:rotate-180">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Go back</span>
                </a>

                <a href="{{route('home')}}"
                    class="w-1/2 px-5 py-2 text-sm tracking-wide text-center text-white transition-colors duration-200 rounded-lg bg-primary-500 shrink-0 sm:w-auto hover:bg-primary-600 dark:hover:bg-primary-500 dark:bg-primary-600">
                    Take me home
                </a>
            </div>
        </div>
        <div class="relative w-full mt-8 bg-center bg-no-repeat bg-cover border rounded-lg dark:border-gray-700 lg:w-1/2 lg:mt-0"
            :style="'background-image: url(' + (theme === 'dark' ? 'https://i.pinimg.com/564x/79/36/c7/7936c7c270b59a94992f1a59c8bdb360.jpg' : 'https://i.pinimg.com/564x/0c/f2/99/0cf299699f1eddff327d941f7c87185b.jpg') + ');'">
            <div class="flex items-center justify-between p-4 rounded-t-lg bg-white/50 backdrop-blur-xl shdaow-xl dark:bg-black/50">
                <div class="dark:text-white">
                    <p class="text-sm font-medium md:text-lg score">Score: 0</p>
                    <p class="text-sm font-medium md:text-lg high-score">High Score: 0</p>
                </div>
                <div>
                    <x-logo class="w-auto h-6 md:h-10" />
                </div>
            </div>
            <div class="relative border dark:border-gray-700  h-[70vmin] rounded-b-lg">
                <div class="absolute top-0 grid w-full h-full play-board" style="grid-template: repeat(30, 1fr) / repeat(30, 1fr);"></div>
            </div>

            <div class="absolute inset-0 flex items-center justify-center space-x-2 rounded-lg start-instructions bg-black/20">
                <div class="flex flex-col items-center justify-center p-6 space-y-2 text-white rounded-md md:p-12 bg-black/50 dark:bg-white/50 ">
                    <div class="flex items-center w-10 h-10 p-2 rounded-lg bg-white/80 md:w-12 md:h-12 ">
                        <x-icon name="chevron-up" class="w-10 h-10 text-black " solid/>
                    </div>
                    <div class="flex space-x-2">
                        <div class="flex items-center w-10 h-10 p-2 rounded-lg bg-white/80 md:w-12 md:h-12 ">
                            <x-icon name="chevron-left" class="w-10 h-10 text-black " solid/>
                        </div>
                        <div class="flex items-center w-10 h-10 p-2 rounded-lg bg-white/80 md:w-12 md:h-12">
                            <x-icon name="chevron-down" class="w-10 h-10 text-black " solid/>
                        </div>
                        <div class="flex items-center w-10 h-10 p-2 rounded-lg bg-white/80 md:w-12 md:h-12 animate-bounce">
                            <x-icon name="chevron-right" class="w-10 h-10 text-black " solid/>
                        </div>
                    </div>
                    <h1 class="text-sm font-medium md:text-base">Press key to start the game</h1>
                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
    <!-- snake game -->
    <script src="{{ asset('js/snake.js') }}" ></script>
@endpush
@endsection

