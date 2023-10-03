<div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : '{{ $item1 }}' }" id="{{ $name }}">
    <!-- The tabs navigation -->
    <nav>
        {{ $title }}
    </nav>

    {{ $content }}
</div>

