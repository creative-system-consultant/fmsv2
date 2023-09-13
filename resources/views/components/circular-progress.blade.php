@props([
    'percent' => '',
    'color' => '',
    'title' => '',
    'title2' => '',
    'total' => '',
])
<style>
    :root {
        --bg-color: white;
    }
    .dark {
        --bg-color: rgb(31, 41, 55);
    }
</style>

<div {{ $attributes->merge(['class' => '']) }}>
    <div >
        <div class="flex flex-col">
            <div class="flex flex-col items-center space-x-0 space-y-2 text-center md:flex-row md:space-x-5 md:text-left md:space-y-0">
                <div class="relative flex items-center justify-center w-[100px] h-[100px] rounded-[50%]"
                    style="
                        background: radial-gradient(closest-side, var(--bg-color) 79%, transparent 80% 100%),
                        conic-gradient({{$color}} {{$percent}}, rgb(218, 218, 218) 0);
                    "
                >
                    <h1 class="absolute text-base text-center dark:text-white">{{$total}}</h1>
                </div>
                <div class="pt-2 space-y-2 text-sm font-semibold dark:text-white md:pt-0 ">
                    <p>{{$title}}</p>
                    <p>{{$title2}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

