<div>
    <x-container title="Profile" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <div class="grid grid-cols-1">
                <div class="mb-6">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <x-card title="Personal Information" x-data="{ open: false }">
                            <div class="flex items-center space-x-2">
                                <x-avatar class="border-2 border-primary-700" size="w-32 h-32" src="{{ (auth()->user()->profile_photo_path) ? asset('storage/'.auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}" />
                                <x-button icon="pencil" label="Change Profile Picture"  x-on:click="open = !open"/>
                            </div>
                            <div x-show="open == true" class="pt-4">
                                <x-form.filepond
                                    label="Upload Profile Picture"
                                    allowImagePreview
                                    imagePreviewMaxHeight="150"
                                    allowFileTypeValidation
                                    acceptedFileTypes="['image/png', 'image/jpg' , 'image/jpeg' ]"
                                    allowFileSizeValidation
                                    maxFileSize="5mb"
                                    wire:model.defer="profile_picture"
                                    name="profile_picture"
                                />
                            </div>
                            <div class="grid grid-cols-1 gap-2 mt-4 md:grid-cols-3">
                                <x-input
                                    wire:model.defer="email"
                                    label="Email"
                                    :disabled="true"
                                />
                                <x-inputs.password
                                    label="New Password"
                                    wire:model.defer="password"
                                />
                                <x-inputs.password
                                    label="Confirm Password"
                                    wire:model.defer="password_confirmation"
                                />
                            </div>
                            <x-slot name="footer">
                                <div class="flex justify-end">
                                    <div class="flex">
                                        <x-button sm primary icon="clipboard-check" label="Update" type="submit" />
                                    </div>
                                </div>
                            </x-slot>
                        </x-card>
                    </form>
                </div>
            </div>
        </div>
    </x-container>
</div>
