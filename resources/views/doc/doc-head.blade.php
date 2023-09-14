<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif


        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('logo.png') }}">

        <!--  bootstrap icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- sweet alert 2 -->
        <link href="{{ asset('assets') }}/css/sweetalert2.css" rel="stylesheet" />

        <!-- animate css -->
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- filepond -->
        <link href="{{ asset('assets') }}/css/filepond.css" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/filepondimagepreview.css" rel="stylesheet" />

        <!-- tippy tooltip -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>

        <!-- lineicons -->
        <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />


        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
        <script type="text/javascript" src="https://unpkg.com/highlightjs-blade/dist/blade.min.js"></script>
        <script>hljs.highlightAll();</script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/monokai-sublime.min.css">

        <wireui:scripts />
        @livewireStyles
        @livewireScripts
        <!-- plugin for sweetalert2  -->
        <script src="{{ asset('assets') }}/js/sweetalert2.js" async></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>



    </head>

    <body x-data="{theme: localStorage.getItem('theme') || 'light',}"
        :class="{ 'dark': theme === 'dark', 'bg-gray-900': theme === 'dark', 'bg-white': theme === 'light' }"
    >

        @yield('content')


        <x-dialog z-index="z-50" blur="sm" align="center" />
        <x-notifications z-index="z-50" />

        <! -- poper js -->
        <script src="{{ asset('assets') }}/js/popper.js"></script>
        <! -- filepond -->
        <script src="{{ asset('assets') }}/js/filepond.js"></script>
        <script src="{{ asset('assets') }}/js/filepondimagepreview.js"></script>
        <script src="{{ asset('assets') }}/js/filepondvalidatesize.js"></script>
        <script src="{{ asset('assets') }}/js/filepondvalidatetype.js"></script>

        <!-- lottie -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.6/lottie.min.js" ></script>
        <script>
            tippy('.tooltipbtn', {
                content:(reference)=>reference.getAttribute('data-title'),
                onMount(instance) {
                    instance.popperInstance.setOptions({
                    placement :instance.reference.getAttribute('data-placement')
                    });
                },
                allowHTML: true,
            });
        </script>
    </body>
    @stack('js')
</html>
