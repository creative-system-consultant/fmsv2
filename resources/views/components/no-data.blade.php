@props([
    'title' => '',
])

<div class="flex items-center justify-center h-64 my-4  ">
    <div class="absolute" style="top: 55%; left: 50%; transform: translate(-50%, -50%);">
        <div class="text-center">
            <x-svg.no-data/>
            <p class="text-center -mt-2 text-lg text-black dark:text-white">
                {{$title}}
            </p>
        </div>
    </div>
</div>