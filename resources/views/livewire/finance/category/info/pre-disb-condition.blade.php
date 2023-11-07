<div>
    <div class=" grid grid-cols-1">
            <div class="grid grid-cols-1 md:grid-cols-2 ">
                <form wire:submit="update">
                <x-card title="Offer Letter">
                    <div>
                        <!--- Start Executed Date -->
                        <div class="space-y-6  sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start ">
                                <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 dark:text-white">
                                    Executed Date
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <x-input 
                                        type="date"
                                        wire:model="agreement_exe_date"
                                        
                                    />
                                </div>
                            </div>
                        </div>
                        <!--- End Executed Date -->

                        <!--- Start View Document -->
                        <div class="mt-6 space-y-6 sm:mt-5 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5  dark:border-gray-700">
                                <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 dark:text-white">
                                    View Document
                                </label>
                                <p class="text-base" >No document</p>
                            </div>
                        </div>
                        <!--- End View Document -->

                        <!--- Start Upload Document -->
                        <div class="mt-6 space-y-6 sm:mt-5 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5  dark:border-gray-700">
                                <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 dark:text-white">
                                    Upload Document
                                </label>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    {{-- <input type="file" id="fileInput" class="hidden w-full" wire:model="siDocument" />

                                    <label for="fileInput" class="w-full py-4 cursor-pointer bg-gray-50 border-2 dark:border-gray-700 dark:bg-gray-800 rounded-xl border-dotted border-primary-400 flex items-center justify-center">
                                        <div class="flex flex-col  items-center justify-center space-x-2">
                                            <x-icon name="cloud-upload" class="w-6 h-6 text-primary-600 animate-bounce mb-2" />
                                            <p class="text-primary-600 text-center text-xs leading-5">
                                                Upload your LO <br>
                                                document.(PDF format only | Max size 3MB)
                                            </p>
                                        </div>
                                    </label>
                                    @if (!is_null($siDocument))
                                        <div class="flex items-center justify-center px-4 py-2 ml-2 bg-red-500 rounded-md cursor-pointer hover:bg-red-600"
                                            wire:click="removeSiDocument">
                                            <p class="text-sm text-white">Remove</p>
                                        </div>
                                    @endif --}}

                                    @if(!$siDocument)
                                    <input type="file" id="fileInput" class="hidden w-full" wire:model.live="siDocument" />
                                    @endif
                                    <label for="fileInput" class="flex items-center justify-center w-full h-24 py-4 border-2 border-dotted {{ (!$siDocument) ? 'cursor-pointer bg-gray-50 dark:border-gray-700 dark:bg-gray-800 rounded-xl border-primary-400' : 'bg-emerald-50 dark:border-emerald-700 dark:bg-emerald-800 rounded-xl border-emerald-400' }} ">
                                        <div class="flex items-center justify-center space-x-2">
                                            @if(!$siDocument)
                                                <x-icon name="cloud-upload" class="w-5 h-5 text-primary-600 animate-bounce" />
                                                <p class="text-xs leading-5 text-center text-primary-600">
                                                    Please choose document
                                                </p>
                                            @else
                                                <x-icon name="cloud-download" class="w-5 h-5 text-emerald-600 animate-bounce" />
                                                <p class="text-xs leading-5 text-center text-emerald-600">
                                                    {{ $siDocument->getClientOriginalName() }}
                                                </p>
                                                <x-icon name="trash" class="w-5 h-5 text-red-600 cursor-pointer" wire:click="clearFile" />
                                            @endif
                                        </div>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <!--- End Upload Document -->

                        <!--- Start Stamping Date -->
                        <div class="mt-6 space-y-6 sm:mt-5 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5  dark:border-gray-700">
                                <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 dark:text-white">
                                    Stamping Date
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <x-input 
                                        type="date"
                                        wire:model="agreement_stamp_date"
                                    />
                                </div>
                            </div>
                        </div>
                        <!--- End Stamping Date -->

                        
                    </div>

                    <div class="flex justify-end items-center py-4  mt-4 border-t dark:border-gray-700">
                    <x-button primary label="Save" wire:click="update" />
                    </div>

                </x-card>
            </form>
            </div>
    </div>
</div>
