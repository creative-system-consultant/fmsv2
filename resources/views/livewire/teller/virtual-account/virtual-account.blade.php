<div>
    <div class="grid grid-cols-1">
        <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700  p-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Total Virtual Account :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Used Virtual Account :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Available Virtal Account :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input 
                            label="Pending Virtal Account :" 
                            wire:model=""
                            disabled
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-4  py-4 rounded-lg dark:bg-gray-900">
            <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
                <x-card title="Virtual Account List" >
                    <x-slot name="action">
                        <div class="flex items-center space-x-2">
                            <x-button 
                                onclick="$openModal('upload-v')"
                                sm  
                                icon="cloud-upload" 
                                cyan 
                                label="Upload VA" 
                            />
                            <x-button 
                                sm  
                                icon="clipboard-check" 
                                green 
                                label="Excel" 
                            />
                            <x-button 
                                onclick="$openModal('create-v')"
                                sm  
                                icon="plus" 
                                primary 
                                label="Create" 
                            />
                        </div>
                    </x-slot>

                    <!-- modal create -->
                    <x-modal.card title="Add Virtual Account" max-width="sm" align="center" blur wire:model.defer="create-v">
                        <div class="grid grid-cols-1  gap-4">
                            <x-input 
                                label="Membership No" 
                                wire:model=""
                            />
                            <x-input 
                                label="Name" 
                                wire:model=""
                            />
                            <x-input 
                                label="Virtual Account Number" 
                                wire:model=""
                            />
                        </div>
                    
                        <x-slot name="footer">
                            <div class="flex justify-end gap-x-4">
                                <x-button flat label="Cancel" x-on:click="close" />
                                <x-button primary label="Save" wire:click="save" />
                            </div>
                        </x-slot>
                    </x-modal.card>

                    <!-- modal upload -->
                    <x-modal.card title="Upload VA Inventory" align="center" blur wire:model.defer="upload-v">
                        <div class="grid grid-cols-1  gap-4">
                            <p class="text-red-500 text-sm">*Must update .xlxs fromat only</p>
                            <div>
                                <input type="file" id="fileInput" class="hidden w-full" />
                                <label for="fileInput" class="w-full cursor-pointer bg-gray-50 border dark:border-gray-700 dark:bg-gray-900 rounded-xl shadow-md h-52 flex items-center justify-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <x-icon name="cloud-upload" class="w-10 h-10 text-primary-600 animate-bounce" />
                                        <p class="text-primary-600">Click or drop files here</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <x-slot name="footer">
                            <div class="flex justify-end gap-x-4">
                                <x-button flat label="Cancel" x-on:click="close" />
                                <x-button primary label="Upload" wire:click="save" />
                            </div>
                        </x-slot>
                    </x-modal.card>
                    
                
                    <!-- list Va -->
                    <div>
                        <x-table.table>
                            <x-slot name="thead">
                                <x-table.table-header class="text-left" value="COLLECTION ACCOUNT NUMBER" sort="" />
                                <x-table.table-header class="text-left" value="VIRTUAL ACCOUNT NUMBER" sort="" />
                                <x-table.table-header class="text-left" value="MEMBERSHIP NUMBER" sort="" />
                                <x-table.table-header class="text-left" value="ACCOUNT NAME" sort="" />
                                <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                                <x-table.table-header class="text-left" value="ITEMS" sort="" />
                                <x-table.table-header class="text-left" value="COOLING PERIOD" sort="" />
                                <x-table.table-header class="text-left" value="VIRTUAL ACCOUNT STATUS" sort="" />
                                <x-table.table-header class="text-left" value="Action" sort="" />
                            </x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        8884000826411
                                    </x-table.table-body>
            
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        8884000826422
                                    </x-table.table-body>
                                
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        06379
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        6379 SAIFULZAMAN BIN AHMAD
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        2022-05-26 16:41:37.737
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        QRAMB0000000002251843
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        -
                                    </x-table.table-body>

                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        -
                                    </x-table.table-body>
            
                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        <x-button 
                                            onclick="$openModal('edit-v')"
                                            sm  
                                            icon="pencil-alt" 
                                            blue 
                                            label="Edit" 
                                        />
                                    </x-table.table-body>
                                </tr>
                            </x-slot>
                        </x-table.table>
                    </div>

                    <!-- modal Edit -->
                    <x-modal.card title="Edit Virtual Account" max-width="sm" align="center" blur wire:model.defer="edit-v">
                        <div class="grid grid-cols-1  gap-4">
                            <x-input 
                                label="Membership No" 
                                wire:model=""
                            />
                            <x-input 
                                label="Name" 
                                wire:model=""
                            />
                            <x-input 
                                label="Virtual Account Number" 
                                wire:model=""
                            />
                        </div>
                    
                        <x-slot name="footer">
                            <div class="flex justify-end gap-x-4">
                                <x-button flat label="Cancel" x-on:click="close" />
                                <x-button primary label="Save" wire:click="save" />
                            </div>
                        </x-slot>
                    </x-modal.card>
                </x-card>
            </div>
        </div>
    </div>
</div>

