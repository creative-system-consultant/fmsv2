<div>
    <div class="px-2">
        <div class="mt-10">
            <div class="pb-4 mb-4 font-semibold border-b dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div class="space-x-2 flex items-start lg:flex-row lg:items-center justify-between flex-col-reverse">
                        <div wire:loading wire:target="selectedSystem">
                            <svg class="h-5 w-5 text-primary-600 dark:text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <div wire:loading.class="hidden">
                            <x-checkbox
                                id="system-checkbox"
                                wire:model.live="selectedSystem"
                                md
                            />
                        </div>
                        <h1 class="font-medium dark:text-white">
                            {{ $currentSystemData->description }} PERMISSIONS
                        </h1>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-label label="Search : " />
                        <div class="w-64">
                            <x-input
                                wire:model.live="search"
                                label=""
                                placeholder="Search Module"
                            />
                        </div>
                    </div>
                </div>
            </div>
            @dump($selectedPermission)
            <div class="mb-6">
                <div>
                    @foreach ($modules as $module)
                        <div class="grid grid-cols-12">
                            <div class="flex items-start col-span-12 md:col-span-3 py-3 border bg-gray-50 dark:bg-gray-900 text-primary-600 dark:border-gray-600">
                                <div class="flex items-center pl-2 font-medium">
                                    <div wire:loading wire:target="selectedModule">
                                        <svg class="h-5 w-5 text-primary-600 dark:text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                    <div wire:loading.class="hidden">
                                        <x-checkbox
                                            id="module-{{ $module->id }}"
                                            wire:model.live="selectedModule"
                                            value="{{ $module->id }}"
                                            md
                                        />
                                    </div>
                                    <div class="flex space-x-1 items-start px-4 text-[0.7rem]">
                                        <x-icon name="collection" class="w-4 h-4"/>
                                        <h1>{{ $module->description }}</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-12  md:col-span-9 border dark:border-gray-600">
                                <div class="grid grid-cols-4 px-3 py-4 gap-x-0 gap-y-4">
                                    @foreach ($permissions->where('system_id', $currentSystem)->where('module_id', $module->id) as $permission)
                                        <div class="flex items-center space-x-2">
                                            <x-checkbox
                                                wire:key="permission-{{ $permission->id }}"
                                                wire:model.live="selectedPermission"
                                                value="{{ $permission->id }}"
                                                md
                                            />
                                            <x-label class="text-[0.69rem] uppercase" label="{{ $permission->name }}"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
