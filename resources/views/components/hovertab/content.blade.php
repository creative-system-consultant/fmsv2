<div class="" x-show="active === {{ $name }}"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100">
    {{ $slot }}
</div>