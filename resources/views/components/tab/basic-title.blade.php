@props([
    'name' => '',
])


<div class="px-4 py-2 w-full rounded-lg cursor-pointer text-gray-500 text-sm" 
x-on:click.prevent="tab = {{ $name }}" x-bind:class="{'text-primary-500 ': tab === {{ $name }} }" 
{{ $attributes }}>
    <div class="flex items-center">
        {{ $slot }}
    </div>
</div>
