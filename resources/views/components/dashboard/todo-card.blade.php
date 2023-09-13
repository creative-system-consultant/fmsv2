<div class="">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="flex items-center justify-center p-4 text-white rounded-lg bg-gradient-to-br from-stone-400 to-stone-600">
                <x-icon name="clipboard-list" class="w-10 h-10 text-white" solid/>
            </div>
            <h1 class="text-3xl font-bold text-slate-500 dark:text-gray-300">To Do List :</h1>
        </div>
    </div>
    <div class="px-2 mx-4 my-6 dark:text-gray-300">
        {{ $slot }}
    </div>
</div>
