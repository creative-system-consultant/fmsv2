<div>
    <div class="grid grid-cols-1">
        <div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12  lg:col-span-7">
                    <x-card title="Autopay Listing To Employer">
                        <div class="grid grid-cols-3 gap-2  items-start">
                            <x-select
                                label="Month"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live=""
                            >
                                <x-select.option label="1" value="1" />
                            </x-select>
                            <x-select
                                label="Year"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live=""
                            >
                                <x-select.option label="1" value="1" />
                            </x-select>
                            <div class="flex mt-7">
                                <x-button 
                                    sm 
                                    icon="document-report" 
                                    green 
                                    label="Excel"
                                    wire:click="" 
                                />
                            </div>
                        </div>
                    </x-card>

                    <div class="mt-10">
                        <x-card title="Upload Autopay Listing From Employer">
                            <span class="text-xs text-red-500 font-semibold">Must update .xlxs fromat only</span>
                            <div class="grid grid-cols-3 gap-2 my-4 items-start">
                                <x-datetime-picker
                                    label="Transaction Date"
                                    wire:model.live=""
                                    without-time=true
                                    display-format="DD/MM/YYYY"
                                />
                                <x-select
                                    label="Employer Name"
                                    placeholder="-- PLEASE SELECT --"
                                    minItemsForSearch="1"
                                    wire:model.live=""
                                >
                                    <x-select.option label="1" value="1" />
                                </x-select>
                                <x-input 
                                    label="Document No"
                                    wire:model.live=""
                                />
                            </div>
                            <div class="my-5">
                                <input type="file" id="fileInput" class="hidden w-full" />
                                <label for="fileInput" class="w-full py-4 cursor-pointer h-24 bg-gray-50 border-2 dark:border-gray-700 dark:bg-gray-800 rounded-xl border-dotted border-primary-400 flex items-center justify-center">
                                    <div class="flex  items-center justify-center space-x-2">
                                        <x-icon name="cloud-upload" class="w-5 h-5 text-primary-600 animate-bounce" />
                                        <p class="text-primary-600 text-center text-xs leading-5">
                                            Please choose document
                                        </p>
                                    </div>
                                </label>
                            </div>
                            <div class="grid grid-cols-3 gap-2 mt-4 items-start">
                                <x-datetime-picker
                                    label="Transaction Date"
                                    wire:model.live=""
                                    without-time=true
                                    display-format="DD/MM/YYYY"
                                    disabled
                                />
                                <x-select
                                    label="Employer Name"
                                    placeholder="-- PLEASE SELECT --"
                                    minItemsForSearch="1"
                                    wire:model.live=""
                                    disabled
                                >
                                    <x-select.option label="1" value="1" />
                                </x-select>
                                <x-input 
                                    label="Document No"
                                    wire:model.live=""
                                    disabled
                                />
                            </div>
                        </x-card>
                    </div>
                </div>

                <div class="col-span-12  lg:col-span-5">
                    <div>
                        <x-card title="LIST of Families (Autopay)">
                            <div class="flex space-x-2 items-center">
                                <x-button 
                                    sm
                                    icon="document-report" 
                                    green 
                                    label="Excel"
                                    wire:click="" 
                                />  
                                <x-button 
                                    sm
                                    icon="pencil-alt" 
                                    primary 
                                    label="Edit"
                                    onclick="$openModal('edit-families')"
                                />  
                            </div>

                            <!-- Edit Autopay Families Modal -->
                            <x-modal.card title="Autopay Family" align="center" blur wire:model.defer="edit-families" fullscreen="true">
                                <div class="mb-4">
                                    <x-button 
                                        xs 
                                        icon="plus" 
                                        green 
                                        label="Create"
                                        onclick="$openModal('add-auto-family')"
                                    />  
                                </div>

                                <!-- modal add auto family -->
                                <x-modal.card title="Add Autopay Family" align="start" blur wire:model.defer="add-auto-family" max-width="6xl" hide-close="true">
                                    <div  x-data="{search: 0 }">
                                        <div>
                                            <div class="pb-10" x-show="search == 1">
                                                <h1 class="font-semibold text-primary-500 pb-2">Search Main Member</h1>
                                                <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row mb-4">
                                                    <x-label label="Search :"/>
                                                    <div>
                                                        <x-native-select  wire:model.live="search_by">
                                                            <option value="">Name</option>
                                                            <option value="">Identity No</option>
                                                            <option value="">Membership Id</option>
                                                            <option value="">Account No</option>
                                                        </x-native-select>
                                                    </div>
                                    
                                                    <div class="w-full sm:w-64">
                                                        <x-input wire:model.lazy="search" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <x-table.table>
                                                    <x-slot name="thead">
                                                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                                        <x-table.table-header class="text-left" value="NAME" sort="" />
                                                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                                581218055265
                                                            </x-table.table-body>
                                                
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                11263
                                                            </x-table.table-body>
                                    
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                A JALAL BIN MD SHAH
                                                            </x-table.table-body>
                                                        
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                ACTIVE
                                                            </x-table.table-body>
                            
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                <div class="flex items-center space-x-2">
                                                                    <x-button 
                                                                        wire:click=""
                                                                        xs  
                                                                        icon="plus" 
                                                                        primary 
                                                                        label="Select" 
                                                                    />
                                                                </div>
                                                            </x-table.table-body>
                                                        </tr>
                                                    </x-slot>
                                                </x-table.table>
                                            </div>

                                            <div class="pb-10" x-show="search == 2">
                                                <h1 class="font-semibold text-yellow-500 pb-2">Search Sub Member</h1>
                                                <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row mb-4">
                                                    <x-label label="Search :"/>
                                                    <div>
                                                        <x-native-select  wire:model.live="search_by">
                                                            <option value="">Name</option>
                                                            <option value="">Identity No</option>
                                                            <option value="">Membership Id</option>
                                                            <option value="">Account No</option>
                                                        </x-native-select>
                                                    </div>
                                    
                                                    <div class="w-full sm:w-64">
                                                        <x-input wire:model.lazy="search" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <x-table.table>
                                                    <x-slot name="thead">
                                                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                                        <x-table.table-header class="text-left" value="NAME" sort="" />
                                                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                                581218055265
                                                            </x-table.table-body>
                                                
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                11263
                                                            </x-table.table-body>
                                    
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                A JALAL BIN MD SHAH
                                                            </x-table.table-body>
                                                        
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                ACTIVE
                                                            </x-table.table-body>
                            
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                <div class="flex items-center space-x-2">
                                                                    <x-button 
                                                                        wire:click=""
                                                                        xs  
                                                                        icon="plus" 
                                                                        primary 
                                                                        label="Select" 
                                                                    />
                                                                </div>
                                                            </x-table.table-body>
                                                        </tr>
                                                    </x-slot>
                                                </x-table.table>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex justify-end">
                                                <x-button 
                                                    xs 
                                                    icon="search" 
                                                    primary 
                                                    label="Search Main"
                                                    @click="search = 1"
                                                />  
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <x-input 
                                                    wire:model="" 
                                                    label="Staff No Main" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Member No Main" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                            </div>
                                            <div class="flex justify-end mt-4">
                                                <x-button 
                                                    xs 
                                                    icon="search" 
                                                    warning 
                                                    label="Search Sub"
                                                    @click="search = 2"
                                                />  
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <x-input 
                                                    wire:model="" 
                                                    label="Staff No" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Member No" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="IC No" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Name" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-select
                                                    label="Code"
                                                    placeholder="-- PLEASE SELECT --"
                                                    minItemsForSearch="1"
                                                    wire:model.live=""
                                                >
                                                    <x-select.option label="1" value="1" />
                                                </x-select>
                                                <x-input 
                                                    wire:model="" 
                                                    label="Amount" 
                                                    placeholder="" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <x-slot name="footer">
                                        <div class="flex justify-end gap-x-2">
                                            <x-button flat label="Cancel" x-on:click="close" />
                                            <x-button primary label="Save" wire:click="save" />
                                        </div>
                                    </x-slot>
                                </x-modal.card>

                                <x-table.table>
                                    <x-slot name="thead">
                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                        <x-table.table-header class="text-left" value="MEMBER NO MAIN" sort="" />
                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                        <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                                        <x-table.table-header class="text-left" value="IC NO" sort="" />
                                        <x-table.table-header class="text-left" value="CODE" sort="" />
                                        <x-table.table-header class="text-right" value="NAME" sort="" />
                                        <x-table.table-header class="text-right" value="PAYMENT AMOUNT" sort="" />
                                        <x-table.table-header class="text-center" value="AMOUNT" sort="" />
                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        <tr>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                100419
                                            </x-table.table-body>
                                
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                02042
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                100197/C
                                            </x-table.table-body>
                                        
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                11386
                                            </x-table.table-body>
                
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                5402042033161
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                523100423
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                BMMB
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                8NAZMI AIMAN BIN SAZALI
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700  text-right">
                                                70.00
                                            </x-table.table-body>

                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                <div class="flex items-center space-x-2">
                                                    <x-button 
                                                        xs 
                                                        icon="pencil-alt" 
                                                        primary 
                                                        label="Edit"
                                                        onclick="$openModal('edit-auto-family')"
                                                    />  
                                                    <x-button 
                                                        wire:click=""
                                                        xs  
                                                        icon="trash" 
                                                        red 
                                                        label="Delete" 
                                                    />
                                                </div>
                                            </x-table.table-body>
                                        </tr>
                                    </x-slot>
                                </x-table.table>

                                <!-- modal Edit auto family -->
                                <x-modal.card title="Edit Autopay Family" align="start" blur wire:model.defer="edit-auto-family" max-width="6xl" hide-close="true">
                                    <div  x-data="{search: 0 }">
                                        <div>
                                            <div class="pb-10" x-show="search == 1">
                                                <h1 class="font-semibold text-primary-500 pb-2">Search Main Member</h1>
                                                <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row mb-4">
                                                    <x-label label="Search :"/>
                                                    <div>
                                                        <x-native-select  wire:model.live="search_by">
                                                            <option value="">Name</option>
                                                            <option value="">Identity No</option>
                                                            <option value="">Membership Id</option>
                                                            <option value="">Account No</option>
                                                        </x-native-select>
                                                    </div>
                                    
                                                    <div class="w-full sm:w-64">
                                                        <x-input wire:model.lazy="search" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <x-table.table>
                                                    <x-slot name="thead">
                                                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                                        <x-table.table-header class="text-left" value="NAME" sort="" />
                                                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                                581218055265
                                                            </x-table.table-body>
                                                
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                11263
                                                            </x-table.table-body>
                                    
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                A JALAL BIN MD SHAH
                                                            </x-table.table-body>
                                                        
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                ACTIVE
                                                            </x-table.table-body>
                            
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                <div class="flex items-center space-x-2">
                                                                    <x-button 
                                                                        wire:click=""
                                                                        xs  
                                                                        icon="plus" 
                                                                        primary 
                                                                        label="Select" 
                                                                    />
                                                                </div>
                                                            </x-table.table-body>
                                                        </tr>
                                                    </x-slot>
                                                </x-table.table>
                                            </div>

                                            <div class="pb-10" x-show="search == 2">
                                                <h1 class="font-semibold text-yellow-500 pb-2">Search Sub Member</h1>
                                                <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row mb-4">
                                                    <x-label label="Search :"/>
                                                    <div>
                                                        <x-native-select  wire:model.live="search_by">
                                                            <option value="">Name</option>
                                                            <option value="">Identity No</option>
                                                            <option value="">Membership Id</option>
                                                            <option value="">Account No</option>
                                                        </x-native-select>
                                                    </div>
                                    
                                                    <div class="w-full sm:w-64">
                                                        <x-input wire:model.lazy="search" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <x-table.table>
                                                    <x-slot name="thead">
                                                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                                        <x-table.table-header class="text-left" value="NAME" sort="" />
                                                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                                581218055265
                                                            </x-table.table-body>
                                                
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                11263
                                                            </x-table.table-body>
                                    
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                A JALAL BIN MD SHAH
                                                            </x-table.table-body>
                                                        
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                ACTIVE
                                                            </x-table.table-body>
                            
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                <div class="flex items-center space-x-2">
                                                                    <x-button 
                                                                        wire:click=""
                                                                        xs  
                                                                        icon="plus" 
                                                                        primary 
                                                                        label="Select" 
                                                                    />
                                                                </div>
                                                            </x-table.table-body>
                                                        </tr>
                                                    </x-slot>
                                                </x-table.table>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex justify-end">
                                                <x-button 
                                                    xs 
                                                    icon="search" 
                                                    primary 
                                                    label="Search Main"
                                                    @click="search = 1"
                                                />  
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <x-input 
                                                    wire:model="" 
                                                    label="Staff No Main" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Member No Main" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                            </div>
                                            <div class="flex justify-end mt-4">
                                                <x-button 
                                                    xs 
                                                    icon="search" 
                                                    warning 
                                                    label="Search Sub"
                                                    @click="search = 2"
                                                />  
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <x-input 
                                                    wire:model="" 
                                                    label="Staff No" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Member No" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="IC No" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Name" 
                                                    placeholder="" 
                                                    disabled
                                                />
                                                <x-select
                                                    label="Code"
                                                    placeholder="-- PLEASE SELECT --"
                                                    minItemsForSearch="1"
                                                    wire:model.live=""
                                                >
                                                    <x-select.option label="1" value="1" />
                                                </x-select>
                                                <x-input 
                                                    wire:model="" 
                                                    label="Amount" 
                                                    placeholder="" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <x-slot name="footer">
                                        <div class="flex justify-end gap-x-2">
                                            <x-button flat label="Cancel" x-on:click="close" />
                                            <x-button primary label="Save" wire:click="save" />
                                        </div>
                                    </x-slot>
                                </x-modal.card>
                            </x-modal.card>

                        </x-card>
                    </div>
                    <div class="mt-4">
                        <x-card title=" LIST of Guarantor (Autopay)">
                            <div class="flex space-x-2 items-center">
                                <x-button 
                                    sm 
                                    icon="document-report" 
                                    green 
                                    label="Excel"
                                    wire:click="" 
                                />  
                                <x-button 
                                    sm 
                                    icon="pencil-alt" 
                                    primary 
                                    label="Edit"
                                    onclick="$openModal('edit-guarantor')"
                                />  
                            </div>

                            <!-- Edit Autopay Guarantor Modal -->
                            <x-modal.card title="Edit Autopay Guarantor" align="center" blur wire:model.defer="edit-guarantor" fullscreen="true">
                                <div class="mb-4">
                                    <x-button 
                                        xs 
                                        icon="plus" 
                                        green 
                                        label="Create"
                                        onclick="$openModal('add-auto-guarantor')"
                                    />  
                                </div>

                                <!-- modal add auto guarantor -->
                                <x-modal.card title="Add Autopay Guarantor" align="start" blur wire:model.defer="add-auto-guarantor" max-width="6xl" hide-close="true">
                                    <div  x-data="{search: 0 }">
                                        <div>
                                            <div class="pb-10" x-show="search == 1">
                                                <h1 class="font-semibold text-primary-500 pb-2">Search Main Member</h1>
                                                <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row mb-4">
                                                    <x-label label="Search :"/>
                                                    <div>
                                                        <x-native-select  wire:model.live="search_by">
                                                            <option value="">Name</option>
                                                            <option value="">Identity No</option>
                                                            <option value="">Membership Id</option>
                                                            <option value="">Account No</option>
                                                        </x-native-select>
                                                    </div>
                                    
                                                    <div class="w-full sm:w-64">
                                                        <x-input wire:model.lazy="search" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <x-table.table>
                                                    <x-slot name="thead">
                                                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                                        <x-table.table-header class="text-left" value="NAME" sort="" />
                                                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                                581218055265
                                                            </x-table.table-body>
                                                
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                11263
                                                            </x-table.table-body>
                                    
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                A JALAL BIN MD SHAH
                                                            </x-table.table-body>
                                                        
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                ACTIVE
                                                            </x-table.table-body>
                            
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                <div class="flex items-center space-x-2">
                                                                    <x-button 
                                                                        wire:click=""
                                                                        xs  
                                                                        icon="plus" 
                                                                        primary 
                                                                        label="Select" 
                                                                    />
                                                                </div>
                                                            </x-table.table-body>
                                                        </tr>
                                                    </x-slot>
                                                </x-table.table>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex justify-end">
                                                <x-button 
                                                    xs 
                                                    icon="search" 
                                                    primary 
                                                    label="Search Main"
                                                    @click="search = 1"
                                                />  
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <x-input 
                                                    wire:model="" 
                                                    label="Member No" 
                                                    placeholder="" 
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Name" 
                                                    placeholder="" 
                                                />
                                                <x-select
                                                    label="Bank"
                                                    placeholder="-- PLEASE SELECT --"
                                                    minItemsForSearch="1"
                                                    wire:model.live=""
                                                >
                                                    <x-select.option label="1" value="1" />
                                                </x-select>
                                                <x-input 
                                                    wire:model="" 
                                                    label="Account No" 
                                                    placeholder="" 
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Amount" 
                                                    placeholder="" 
                                                />
                                                <x-select
                                                    label="Status"
                                                    placeholder="-- PLEASE SELECT --"
                                                    minItemsForSearch="1"
                                                    wire:model.live=""
                                                >
                                                    <x-select.option label="1" value="1" />
                                                </x-select>
                                            </div>
                                        </div>
                                    </div>
                                    <x-slot name="footer">
                                        <div class="flex justify-end gap-x-2">
                                            <x-button flat label="Cancel" x-on:click="close" />
                                            <x-button primary label="Save" wire:click="save" />
                                        </div>
                                    </x-slot>
                                </x-modal.card>

                                <x-table.table>
                                    <x-slot name="thead">
                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                        <x-table.table-header class="text-left" value="MEMBER NO MAIN" sort="" />
                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                        <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                                        <x-table.table-header class="text-left" value="IC NO" sort="" />
                                        <x-table.table-header class="text-left" value="CODE" sort="" />
                                        <x-table.table-header class="text-right" value="NAME" sort="" />
                                        <x-table.table-header class="text-right" value="PAYMENT AMOUNT" sort="" />
                                        <x-table.table-header class="text-center" value="AMOUNT" sort="" />
                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        <tr>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                100419
                                            </x-table.table-body>
                                
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                02042
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                100197/C
                                            </x-table.table-body>
                                        
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                11386
                                            </x-table.table-body>
                
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                5402042033161
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                523100423
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                BMMB
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                8NAZMI AIMAN BIN SAZALI
                                            </x-table.table-body>
                    
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700  text-right">
                                                70.00
                                            </x-table.table-body>

                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                <div class="flex items-center space-x-2">
                                                    <x-button 
                                                        xs 
                                                        icon="pencil-alt" 
                                                        primary 
                                                        label="Edit"
                                                        onclick="$openModal('edit-auto-guarantor')"
                                                    />  
                                                    <x-button 
                                                        wire:click=""
                                                        xs  
                                                        icon="trash" 
                                                        red 
                                                        label="Delete" 
                                                    />
                                                </div>
                                            </x-table.table-body>
                                        </tr>
                                    </x-slot>
                                </x-table.table>

                                <!-- modal Edit auto guarantor -->
                                <x-modal.card title="Edit Autopay Guarantor" align="start" blur wire:model.defer="edit-auto-guarantor" max-width="6xl" hide-close="true">
                                    <div  x-data="{search: 0 }">
                                        <div>
                                            <div class="pb-10" x-show="search == 1">
                                                <h1 class="font-semibold text-primary-500 pb-2">Search Main Member</h1>
                                                <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row mb-4">
                                                    <x-label label="Search :"/>
                                                    <div>
                                                        <x-native-select  wire:model.live="search_by">
                                                            <option value="">Name</option>
                                                            <option value="">Identity No</option>
                                                            <option value="">Membership Id</option>
                                                            <option value="">Account No</option>
                                                        </x-native-select>
                                                    </div>
                                    
                                                    <div class="w-full sm:w-64">
                                                        <x-input wire:model.lazy="search" placeholder="Search" />
                                                    </div>
                                                </div>
                                                <x-table.table>
                                                    <x-slot name="thead">
                                                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                                        <x-table.table-header class="text-left" value="NAME" sort="" />
                                                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                                                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                                581218055265
                                                            </x-table.table-body>
                                                
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                11263
                                                            </x-table.table-body>
                                    
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                A JALAL BIN MD SHAH
                                                            </x-table.table-body>
                                                        
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                ACTIVE
                                                            </x-table.table-body>
                            
                                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                                <div class="flex items-center space-x-2">
                                                                    <x-button 
                                                                        wire:click=""
                                                                        xs  
                                                                        icon="plus" 
                                                                        primary 
                                                                        label="Select" 
                                                                    />
                                                                </div>
                                                            </x-table.table-body>
                                                        </tr>
                                                    </x-slot>
                                                </x-table.table>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex justify-end">
                                                <x-button 
                                                    xs 
                                                    icon="search" 
                                                    primary 
                                                    label="Search Main"
                                                    @click="search = 1"
                                                />  
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <x-input 
                                                    wire:model="" 
                                                    label="Member No" 
                                                    placeholder="" 
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Name" 
                                                    placeholder="" 
                                                />
                                                <x-select
                                                    label="Bank"
                                                    placeholder="-- PLEASE SELECT --"
                                                    minItemsForSearch="1"
                                                    wire:model.live=""
                                                >
                                                    <x-select.option label="1" value="1" />
                                                </x-select>
                                                <x-input 
                                                    wire:model="" 
                                                    label="Account No" 
                                                    placeholder="" 
                                                />
                                                <x-input 
                                                    wire:model="" 
                                                    label="Amount" 
                                                    placeholder="" 
                                                />
                                                <x-select
                                                    label="Status"
                                                    placeholder="-- PLEASE SELECT --"
                                                    minItemsForSearch="1"
                                                    wire:model.live=""
                                                >
                                                    <x-select.option label="1" value="1" />
                                                </x-select>
                                            </div>
                                        </div>
                                    </div>
                                    <x-slot name="footer">
                                        <div class="flex justify-end gap-x-2">
                                            <x-button flat label="Cancel" x-on:click="close" />
                                            <x-button primary label="Save" wire:click="save" />
                                        </div>
                                    </x-slot>
                                </x-modal.card>
                                
                            </x-modal.card>

                        </x-card>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <x-card title="View Details Exception">
                <div class="flex items-center justify-between  mb-5">
                    <div class="flex sm:items-center space-y-2 sm:space-x-2 flex-col sm:flex-row">
                        <x-label label="Search :" class="mt-2"/>
                        <div class="w-full sm:w-64">
                            <x-input wire:model.lazy="search" placeholder="Search" />
                        </div>
                    </div>
                    <x-button 
                        sm
                        icon="paper-airplane" 
                        green 
                        label="Submit"
                        wire:click="" 
                    />  
                </div>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                        <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                        <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                        <x-table.table-header class="text-left" value="CATEGORY" sort="" />
                        <x-table.table-header class="text-right" value="INSTALMENT AMOUNT" sort="" />
                        <x-table.table-header class="text-right" value="PAYMENT AMOUNT" sort="" />
                        <x-table.table-header class="text-center" value="DOCUMENT NO" sort="" />
                        <x-table.table-header class="text-right" value="THIRDPARTY MODE" sort="" />
                        <x-table.table-header class="text-center" value="THIRDPARTY ID" sort="" />
                        <x-table.table-header class="text-center" value="CODE" sort="" />
                        <x-table.table-header class="text-center" value="STATUS" sort="" />
                        <x-table.table-header class="text-right" value="NEW AMOUNT" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                100419
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                02042
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                680907075441
                            </x-table.table-body>
                        
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                BANYAMIN BIN AYOB KHAN
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                5402042033161
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                CONTRIBUTION
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                80.00
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                80.00
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700  ">
                                OCT 23 - BMMB
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                0
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                0
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                BMMB
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                -
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right ">
                                0.00
                            </x-table.table-body>
    
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center space-x-2">
                                    <x-button 
                                        xs 
                                        icon="pencil-alt" 
                                        primary 
                                        label="Edit"
                                        onclick="$openModal('edit-details-exception')"
                                    />  
                                    <x-button 
                                        wire:click=""
                                        xs  
                                        icon="trash" 
                                        red 
                                        label="Delete" 
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>

                <!-- modal -->
                <x-modal.card title="Edit Exception Details" align="center" blur wire:model.defer="edit-details-exception" max-width="lg" hide-close="true">
                    <div class="grid gap-4 my-2 lg:grid-cols-1 ">
                        <x-input 
                            wire:model="" 
                            label="New Amount" 
                            placeholder="" 
                            class="uppercase"
                        />
                    </div>

                    <x-slot name="footer">
                        <div class="flex justify-end">
                            <div class="flex">
                                <x-button primary label="Update" wire:click="" />
                            </div>
                        </div>
                    </x-slot>
                </x-modal.card>
                <!-- end modal -->
            </x-card>
        </div>
        
    </div>
</div>
