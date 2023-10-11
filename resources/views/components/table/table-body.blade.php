@props([
    'colspan' => '',
])

<td {{ ($colspan != '') ? 'colspan = '.$colspan : '' }} {{ $attributes->merge(['class' => 'px-6  py-0.5 whitespace-no-wrap text-xs leading-5  dark:bg-gray-900 dark:text-white']) }}>
    {{ $slot }}
</td>
