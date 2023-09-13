<div x-cloak x-show="theme === 'dark'">
    <x-switch-theme
        click="theme = (theme === 'light' ? 'dark' : 'light'); localStorage.setItem('theme', theme)"
        type="dark"
    />
</div>

<div x-cloak x-show="theme === 'light'">
    <x-switch-theme
        click="theme = (theme === 'light' ? 'dark' : 'light'); localStorage.setItem('theme', theme)"
        type="light"
    />
</div>
