@props([
    'title' => '',
    'routeBackBtn' => '',
    'titleBackBtn' => '',
    'disableBackBtn' => 'false'
])

<div class="px-2 lg:px-10">
    @if($disableBackBtn == 'true')
        <div class="flex mt-12 lg:mt-2">
            <a href="{{$routeBackBtn}}" class="flex items-center space-x-2 text-white transition ease-in-out delay-75 scale-95 dark:text-white hover:scale-100">
                <x-icon name="arrow-left" class="w-6 h-6"/>
                <p class="myFontRegular">Back to {{$titleBackBtn}}</p>
            </a>
        </div>
    @endif
    <h1 class="py-6 text-3xl font-medium text-white uppercase myFontSemibold dark:text-white animate__animated animate__fadeInLeft animate__faster">
        {{$title}}
    </h1>
    <div class="px-4 py-5 mb-24 bg-white border rounded-lg shadow-sm lg:px-10 dark:bg-gray-800 dark:border-none">
        <div class="py-4 ">
            {{$slot}}
        </div>
    </div>
</div>
