@props([
    'name' => '',
])

<a href="#"
    x-on:click.prevent="tab = {{ $name }}"
    class="p-4 -mb-px border-current"
    :class="tab === {{$name}} ? 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600 dark:border-primary-400' : ' text-gray-500 dark:text-gray-100 '"
    {{ $attributes }}>
    {{$slot}}
</a>
