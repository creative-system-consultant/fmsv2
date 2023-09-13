@extends('layouts.base')

@section('body')

<div x-data="{
        toggleSidebarMobile:false,
        toggleSidebarDesktop:localStorage.getItem('toggleSidebarDesktop')  === 'true',
        toggleMiniSidebar:localStorage.getItem('toggleMiniSidebar')  === 'true',
    }">
    <div class="flex ">
        @include('include.sidebar')
        <div
            x-on:click="toggleSidebarMobile = !toggleSidebarMobile"
            class="fixed inset-0 z-10 bg-gray-900 opacity-50"
            x-bind:class="{ 'hidden': !toggleSidebarMobile, 'block': toggleSidebarMobile }" x-cloak>
        </div>
        <div class="relative z-0 w-full bg-gray-50 dark:bg-gray-900"
        :class="{
            'block lg:ml-0': toggleSidebarDesktop && toggleMiniSidebar,
            'lg:ml-0': !toggleSidebarDesktop && !toggleMiniSidebar,
            'block lg:ml-[5rem]':  !toggleSidebarDesktop && toggleMiniSidebar,
            'lg:ml-64':  !toggleSidebarDesktop
        }"x-cloak>
        @include('include.navbar')
            <div class="bg-center bg-cover" :style="'background-image: url(' + (theme === 'dark' ? '{{asset('headerLight.png')}}' : '{{asset('headerLight.png')}}') + ');'">
                <main class="w-full px-2 pt-24 pb-20 -mt-20 " :class="theme === 'dark' ? 'bg-gray-900/80' : 'bg-gray-400/50'">
                    <div class="">
                        <!--content-->
                        <div class="relative">
                            @yield('content')

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
@endsection
