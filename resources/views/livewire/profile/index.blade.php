<div>
    <x-container title="Profile" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <div class="grid grid-cols-1">
                <div class="mb-6">
                    <x-card title="Personal Information">
                        <div class="flex items-center space-x-2">
                            <x-avatar size="w-32 h-32" class="border-primary-700 border-2" src="https://picsum.photos/300?size=lg" />
                            <input type="file" id="fileInput" class="hidden w-full" />
                            <label for="fileInput" class="btn">
                                <x-icon name="cloud-upload" class="w-4 h-4" />
                                <p>Change Profile Photo</p>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
                            <x-input
                                wire:model.defer=""
                                label="Username"
                            />
                            <x-input
                                wire:model.defer=""
                                label="Email"
                            />
                            <x-input
                                wire:model.defer=""
                                label="IC No"
                            />
                            <x-input
                                wire:model.defer=""
                                label="Role"
                                disabled
                            />
                        </div>
                        <x-slot name="footer">
                            <div class="flex justify-end">
                                <div class="flex">
                                    <x-button sm primary icon="clipboard-check" label="Update" />
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                </div>
                <div  class="mb-6">
                    <x-card title="Change Password">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
                            <x-inputs.password 
                                label="Current Password" 
                                wire:model.defer=""
                            />
                            <x-inputs.password 
                                label="New Password" 
                                wire:model.defer=""
                            />
                            <x-inputs.password 
                                label="Confirm Password" 
                                wire:model.defer=""
                            />
                        </div>
                        <x-slot name="footer" >
                            <div class="flex justify-end">
                                <div class="flex">
                                    <x-button sm primary icon="clipboard-check" label="Update" />
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </x-container>
</div>
