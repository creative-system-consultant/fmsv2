@props([
    'name' => '',
])
<div class="" x-show="tab === {{ $name }}" x-cloak>
    {{ $slot }}
</div>
