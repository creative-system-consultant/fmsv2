
@props([
    'percent' => '',
    'colors' => '',
    'title' => '',
    'total' => '',
    'route' => '',
])

<a href="{{$route == '' ? 'javascript:void(0);' : $route }}"
    class="px-4 transition ease-in-out delay-75 scale-95 rounded-lg shadow-xl backdrop-blur-xl bg-white/60 dark:bg-black/50 hover:scale-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4 ">
            <div class="pt-4">
                <x-circular-progress
                    color="{{$colors}}"
                    percent="{{$percent}}%"
                    total="{{$total}}"
                />
            </div>
            <div class="space-y-2 ">
                <h1 class="text-sm text-gray-600 md:text-lg dark:text-gray-300 xl:text-sm 2xl:text-lg">
                    {{$title}}
                </h1>
            </div>
        </div>
        @if($route)
        <div class="p-2 bg-gray-100 border-4 rounded-full dark:bg-secondary-800 dark:text-white dark:border-secondary-600">
            <x-icon name="chevron-right" class="w-4 h-4"/>
        </div>
        @endif
    </div>
</a>
