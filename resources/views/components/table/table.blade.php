
<style>
    table, td, th {
        white-space: nowrap;
    }
</style>
<div class="relative z-0 flex flex-col">
    <div class="-my-2 overflow-x-auto ">
        <div class="inline-block min-w-full py-2 align-middle">
            <div class="overflow-hidden bg-white border border-gray-200 shadow sm:rounded-lg dark:bg-gray-900 dark:border-gray-600 ">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead>
                        <tr>
                            {{ $thead }}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600">
                        {{ $tbody }}
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
