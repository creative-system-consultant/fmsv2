@props([
    'title' => '',
    'href' => '',
    'btn' => 'false'
])

<div class="flex flex-col items-center justify-center pb-10">
    <img src="{{asset('nodata.svg')}}" class="w-auto h-64"/>
    <div class="-mt-4 space-y-2 text-center">
        <h1 class="text-base md:text-xl myFontBold dark:text-gray-400">No Data</h1>
        @if($btn == 'true')
        <h4 class="pb-2 text-sm text-gray-500 myFontRegular md:text-base dark:text-gray-400"> Click New {{$title}} to add new {{$title}} </h4>
        <x-button href="{{ $href }}" icon="plus" outline primary label="New {{$title}}"
            class="text-lg font-bold"
        />
        @endif
    </div>
</div>
