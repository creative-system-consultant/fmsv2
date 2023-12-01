<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Edit Role" routeBackBtn="{{ route('roles.index') }}" titleBackBtn="List Role" disableBackBtn="true">
            <div class="sticky top-[4.2rem] bg-white z-50 pt-2">
                <div class="gap-4 my-2 mb-4">
                    <x-input wire:model="name" label="Role Name" placeholder="" class="uppercase "/>
                </div>
                <div class="grid grid-cols-1" x-data="{ tab:1 }" >
                    <div class="w-full bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
                        <div class="flex itmes-center justify-between">
                            <div class="flex flex-wrap justify-start sm:justify-start">
                                @foreach ($system as $systems)
                                    <x-tab.title name="{{ $systems->id }}" wire:click="setState({{ $systems->id }})" wire:key="{{ $systems->id }}">
                                        <div class="flex items-center text-sm spcae-x-2">
                                            <x-icon name="collection" class="w-5 h-5 mr-2"/>
                                            <h1>{{ $systems->description }}</h1>
                                        </div>
                                    </x-tab.title>
                                @endforeach
                            </div>
                            <div class="flex items-center space-x-2 px-4">
                                <a   href="{{ route('roles.index') }}" class="flex items-center space-x-2 text-gray-500 text-xs border p-2 rounded-md bg-gray-50">
                                    <x-icon name="arrow-left" class="w-4 h-4"/>
                                    <p class="myFontRegular">Back to List Role</p>
                                </a>
                                <x-button primary label="Save" wire:click="update" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <livewire:sys-admin.edit-role-body :systemId=$currentSystem :roleId="$role->id" :name=$name wire:key="edit-role-body-{{$currentSystem}}" />
    </x-container>
</div>
