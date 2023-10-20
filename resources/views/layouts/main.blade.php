@extends('layouts.base')

@section('body')

<div x-data="{
        openHoverMiniSidebar: false,
        toggleSidebarMobile:false,
        toggleSidebarDesktop:localStorage.getItem('toggleSidebarDesktop')  === 'true',
        toggleMiniSidebar:localStorage.getItem('toggleMiniSidebar')  === 'true',
    }">
    <div class="flex w-full">
        @include('include.sidebar')
        <div
            x-on:click="toggleSidebarMobile = !toggleSidebarMobile"
            class="fixed inset-0 z-10 bg-gray-900 opacity-50"
            x-bind:class="{ 'hidden': !toggleSidebarMobile, 'block': toggleSidebarMobile }" x-cloak>
        </div>
        <div class="relative z-0 w-full bg-white dark:bg-gray-900 "
        x-bind:class="{
            'block lg:ml-0': toggleSidebarDesktop && toggleMiniSidebar,
            'lg:ml-0': !toggleSidebarDesktop && !toggleMiniSidebar,
            'block lg:ml-[5rem]': !toggleSidebarDesktop && toggleMiniSidebar && !openHoverMiniSidebar,
            'block lg:ml-[16rem]': openHoverMiniSidebar,
            'lg:ml-64': !toggleSidebarDesktop
        }" x-cloak>
        @include('include.navbar')
        <div
            x-show="theme === 'light'"
            class=" w-full h-[15rem] md:h-[27rem] bg-center bg-cover  md:-mt-[5rem]"
            style="background-image:url('{{asset('headerLight.png')}}');">
        </div>
        <div
            x-show="theme === 'dark'"
            class=" w-full h-[15rem] md:h-[27rem] bg-center bg-cover  md:-mt-[5rem]"
            style="background-image:url('{{asset('headerLight.png')}}');">
        </div>
        <div class="absolute inset-0 transition duration-300 ease-in-out bg-gray-400/50 dark:bg-gray-900/50 md:h-[26.3rem] h-[19rem]"></div>
            <main class="w-full">
                <div class="-mt-[15rem] md:-mt-[22rem] ">
                    <!--content-->
                    <div class="relative ">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
