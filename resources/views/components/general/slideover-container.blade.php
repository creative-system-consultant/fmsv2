@props([
    'xdataName' => '',
    'title' => '',
    'placeholderSearch'
])
<div class="relative z-10">
    <div class="fixed inset-0 bg-gray-200/20 dark:bg-gray-900/50 backdrop-blur-sm" x-on:click="{{$xdataName}} = false"></div>
    <div class="fixed rigth-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div class="pointer-events-auto relative w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl  animate__animated animate__fadeInRight dark:bg-gray-900">
                        <div class="relative flex-shrink-0 overflow-hidden bg-primary-600 ">
                            <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                            </svg>
                            <div class="relative flex items-center justify-between p-4">
                                <h2 class="font-semibold text-white uppercase text-sm">
                                    {{$title}}
                                </h2>
                                <div class="cursor-pointer" x-on:click="{{$xdataName}} = false">
                                    <x-icon name="x-circle" class="w-7 h-7 text-white "/>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex-1 px-4 mt-6 sm:px-4">
                            <div class="mb-4">
                                <div x-on:click="{{$xdataName}} = true">
                                    <x-input
                                        placeholder="{{$placeholderSearch}}"
                                        id="myInput"
                                        onkeyup="myFunction()"
                                    />
                                </div>
                                <div class="py-3 mt-4 border-2 rounded border-primary-50 dark:border-gray-800 relative">
                                    <div class="h-full leading-6" aria-hidden="true">
                                        <ul id="myUL" class="list-none" x-on:click="{{$xdataName}} = false">
                                            {{$slot}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("div")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
@endpush