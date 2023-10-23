<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="FMS - Also known as “KOPERASI Financing Management” Used to manage information of “KOPERASI members and their financing."
        />
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

        @wireUiScripts
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

        @yield('body')


        <x-dialog z-index="z-50" blur="sm" align="center" />
        <x-notifications z-index="z-50" />

        <! -- poper js -->
        <script src="{{ asset('assets') }}/js/popper.js"></script>
        
        <! -- filepond -->
        <script src="{{ asset('assets') }}/js/filepond.js"></script>
        <script src="{{ asset('assets') }}/js/filepondimagepreview.js"></script>
        <script src="{{ asset('assets') }}/js/filepondvalidatesize.js"></script>
        <script src="{{ asset('assets') }}/js/filepondvalidatetype.js"></script>

        <!-- sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- lottie -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.6/lottie.min.js" ></script>

        <!-- sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
            FilePond.registerPlugin(FilePondPluginImagePreview);
        </script>

        <script>
            function createPopper(element, target) {
                return createPopperInstance(element, target, {
                    placement: 'bottom-start',
                    strategy: 'fixed',
                    modifiers: [
                        { name: 'offset', options: { offset: [0, 8] } },
                    ]
                });
            }
            function createPopperInstance(element, target, options) {
                return Popper.createPopper(element, target, options);
            }
            document.addEventListener('DOMContentLoaded', function() {
                const dropdowns = document.querySelectorAll('.relative.inline-block [x-ref="dropdownContent"]');

            dropdowns.forEach((dropdown) => {
                const button = dropdown.previousElementSibling;

                createPopper(button, dropdown);
                });
            });
        </script>

        <script>
            window.addEventListener('swal', function(e) {
                if (e.detail['type'] == 'confirm') {
                    Swal.fire(e.detail).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emit(e.detail['postEvent'], e.detail['id'])
                        }
                    });
                } else {
                    Swal.fire(e.detail);
                }
            });
        </script>
        @if (session()->has('failedPermission'))
            <script>
                notification = @json(session()->pull("failedPermission"));
                setTimeout(() => {
                    Swal.fire(notification)
                }, 1000);

                @php
                    session()->forget('failedPermission');
                @endphp
            </script>
        @endif

        <script>
            $(document).ready(function() {
            const projectsMetaTag = document.querySelector('meta[name="user-projects"]');
                if (projectsMetaTag) {
                    const projectIds = JSON.parse(projectsMetaTag.content);

                    projectIds.forEach((projectId) => {
                        window.Echo.private(`project.${projectId}`)
                    });
                }
            });
        </script>

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
    @stack('ckeditor')
</html>
