@props([
    'bg' => '',
    'active' => '',
    'tab' => '',
    'content' => '',
])

<ul class="mb-1 border rounded-md cursor-pointer" {{ $attributes }}>
    <li class="flex flex-col align-center">
        <div class="w-full px-2 py-2  text-left bg-{{ $bg }} rounded-md"
            @click="{{ $active }} !== {{ $tab }} ? {{ $active }} = {{ $tab }} : {{ $active }} = null">
            <div class="flex items-center justify-between">
                {{ $title }}
                <div class="flex items-center p-2 mx-4 text-white rounded-full bg-primary-800">
                    <div x-show="{{ $active }} !== {{ $tab }}">
                        <x-icon name="chevron-left"  class="w-4 h-4"/>
                    </div>
                    <div x-show="{{ $active }} == {{ $tab }}">
                        <x-icon name="chevron-down"  class="w-4 h-4"/>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="{{ $active }} == {{ $tab }}" class="px-2 py-4 bg-white " x-cloak>
            {{ $content }}
        </div>
    </li>
</ul>
