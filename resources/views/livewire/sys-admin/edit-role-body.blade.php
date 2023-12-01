<div>
    <div class="px-2">
        <div class="mt-10">
            <div class="pb-4 mb-4 font-semibold border-b dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center pl-2 mt-3 space-x-2">
                        <x-checkbox
                            id="system-checkbox"
                            wire:model.live="selectedSystem"
                        />
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
                            <div class="flex items-start col-span-2 py-3 border bg-gray-50 dark:bg-gray-900 text-primary-600 dark:border-gray-600">
                                <div class="flex items-center pl-2 font-medium">
                                    <x-checkbox
                                        id="module-{{ $module->id }}"
                                        wire:model.live="selectedModule"
                                        value="{{ $module->id }}"
                                        md
                                    />
                                    <div class="flex space-x-1 items-start px-4 text-[0.7rem]">
                                        <x-icon name="collection" class="w-4 h-4"/>
                                        <h1>{{ $module->description }}</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-10 border dark:border-gray-600">
                                <div class="grid grid-cols-4 px-3 py-4 gap-x-0 gap-y-4">
                                    @foreach ($permissions->where('system_id', $currentSystem)->where('module_id', $module->id) as $permission)
                                        <div class="flex items-center space-x-2">
                                            <x-checkbox
                                                wire:key="permission-{{ $permission->id }}"
                                                wire:model.live="selectedPermission"
                                                value="{{ $permission->id }}"
                                            />
                                            <x-label class="text-[0.7rem] uppercase" label="{{ $permission->name }}"/>
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

    <div class="flex justify-end px-2 py-4 bg-gray-50 dark:bg-gray-900">
        <div class="flex items-center space-x-2">
            <x-button flat label="Cancel" href="{{ route('roles.index') }}"  />
            <x-button primary label="Save" wire:click="update" />
        </div>
    </div>
</div>
