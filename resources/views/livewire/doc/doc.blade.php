<div>
    <div class="p-4" x-cloak>
        <div x-data="{tab : 0}">
            <div class="flex w-full mb-2 overflow-x-auto rounded-md bg-primary-50 flex-nowrap">
                <x-tab.title name="0" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-icon name="document-text" class="w-6 h-6 mr-2"/>
                        <p>Create Livewire</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-icon name="document-text" class="w-6 h-6 mr-2"/>
                        <p>Component</p>
                    </div>
                </x-tab.title>
            </div>
            <div class="pt-4 bg-white border-t-2">
                <x-tab.content name="0">
                    <div class="p-4" x-data="{selected : 0}" >
                        <h1 class="mb-6 text-base font-semibold md:text-2xl"></h1>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">To Create livewire page, must run this command for folder strucure</h2>
                                <p class="font-semibold">Code</p>
                                <pre class="-mt-4 language-html" wire:ignore>
                                    <code class="language-html">
php artisan make:livewire Module/FolderOfModule/YourPageName
                                    </code>
                                </pre>
                            </div>
                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Every Your Page livewire.php you must be <span class="text-red-500">extend layouts.main</span></h2>
                                <p class="font-semibold">Code</p>
                                <pre class="-mt-4 language-html" wire:ignore>
                                    <code class="language-php">
class Home extends Component
{
    public function render()
    {
        return view('livewire.home.home')->extends('layouts.main');
    }
}
                                    </code>
                                </pre>
                            </div>
                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Every Your Page livewire.blade.php you must be start with the component <span class="text-red-500">"x-container"</span></h2>
                                <p class="font-semibold">Code</p>
                                <pre class="-mt-4 language-html" wire:ignore>
                                    <code class="language-html">
&lt;div>
    &lt;x-container title="Title Of Page" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        &lt;div>
            {{-- Your Content --}}
        &lt;/div>
    &lt;/x-container>
&lt;/div>
                                    </code>
                                </pre>
                            </div>
                        </div>
                    </div>
                </x-tab.content>

                <x-tab.content name="1">
                    <div class="p-4" x-data="{selected : 0}" >
                        <h1 class="mb-6 text-base font-semibold md:text-2xl"></h1>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-1">
                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">For <span class="text-primary-500">Form Component</span> you can refer Wire Ui Doc <span class="text-red-500">Except Table Component</span></h2>
                                <a href="https://livewire-wireui.com/docs/get-started" target="_blank" class="text-blue-500 border-b hover:text-blue-600">
                                    https://livewire-wireui.com/docs/get-started
                                </a>
                            </div>

                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Table Component</h2>
                                <div>
                                    <x-table.table>
                                        <x-slot name="thead">
                                            <x-table.table-header class="text-left" value="Header 1" sort="" />
                                            <x-table.table-header class="text-left" value="Header 2" sort="" />
                                            <x-table.table-header class="text-left" value="Header 2" sort="" />
                                        </x-slot>
                                        <x-slot name="tbody">
                                            <tr>
                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    Header 1
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    Header 2
                                                </x-table.table-body>

                                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                    Header 3
                                                </x-table.table-body>
                                            </tr>
                                        </x-slot>
                                    </x-table.table>
                                </div>

                                <p class="mt-4 font-semibold">Code</p>
                                <pre class="-mt-4 language-html" wire:ignore>
                                    <code class="language-html">
&lt;x-table.table>
    &lt;x-slot name="thead">
        &lt;x-table.table-header class="text-left" value="Header 1" sort="" />
        &lt;x-table.table-header class="text-left" value="Header 2" sort="" />
        &lt;x-table.table-header class="text-left" value="Header 2" sort="" />
    &lt;/x-slot>
    &lt;x-slot name="tbody">
        &lt;tr>
            &lt;x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                Header 1
            &lt;/x-table.table-body>

            &lt;x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                Header 2
            &lt;x-table.table-body>

            &lt;x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                Header 3
            &lt;/x-table.table-body>
        &lt;/tr>
    &lt;/x-slot>
&lt;x-table.table>
                                    </code>
                                </pre>
                            </div>

                        </div>
                    </div>
                </x-tab.content>

            </div>
        </div>
    </div>
</div>
