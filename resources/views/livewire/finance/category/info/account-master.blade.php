<div>
    <div class=" grid grid-cols-1">
        <x-card title="Account Master Details" >
            <x-slot name="action" >
                <div class="flex items-center justify-center space-x-2">
                    <x-button primary label="Payment Voucher" sm />
                    <x-button primary label="Print" sm />
                    <x-button wire:click="editDetail" icon="pencil" primary label="Edit" sm />
                    <x-button icon="save" primary label="Save" sm/>
                </div>
            </x-slot>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Account No" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Product Name" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Product Concept" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Approved Amount" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Approved Date" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Apply Date" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Duration (Month)" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Purchased Price" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Selling Price" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Payment Term" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Profit Rate" 
                    value=""
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Instalment Amount" 
                    wire:model=""
                    disabled
                />

                <x-native-select label="Account Status"  wire:model="" disabled>
                    <option value=""></option>
                </x-native-select>

                <x-input 
                    label="Start Disbursed Date" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Account Status Changed Date" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Start Instalment Date" 
                    wire:model=""
                    disabled
                />

                <x-native-select label="Payment Type"  wire:model="" disabled>
                    <option value=""></option>
                </x-native-select>

                <x-input 
                    label="Reschedule Status" 
                    wire:model=""
                    disabled
                />

                <div class="flex items-center">
                    <div class="w-full">
                        <x-input 
                            label="Payer Staff No." 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="mt-6 ml-2">
                        <x-button 
                            onclick="$openModal('search-modal')"
                            icon="search" 
                            primary 
                            label="Search" 
                            sm
                        />
                    </div>

                    <x-modal.card title="Search Payer" align="center" max-width="6xl" blur wire:model.defer="search-modal">
                        <div class="grid grid-cols-1 sgap-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <x-label label="Search :"/>
                                <div>
                                    <x-native-select  wire:model="model">
                                        <option value="">Name</option>
                                        <option value="">Identity No</option>
                                        <option value="">Membership Id</option>
                                        <option value="">Staff No</option>
                                    </x-native-select>
                                </div>
                
                                <div class="w-64">
                                    <x-input 
                                        wire:model="search"
                                        placeholder="Search"
                                    />
                                </div>
                            </div>
                            <x-table.table>
                                <x-slot name="thead">
                                    <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                    <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                    <x-table.table-header class="text-left" value="NAME" sort="" />
                                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                                    <x-table.table-header class="text-left" value="Action" sort="" />
                                </x-slot>
                                <x-slot name="tbody">
                                    <tr>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            
                                        </x-table.table-body>
                
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>
                                    
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>
                
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <x-button 
                                                x-on:click="close"
                                                sm  
                                                icon="plus" 
                                                primary 
                                                label="Select" 
                                            />
                                        </x-table.table-body>
                                    </tr>
                                </x-slot>
                            </x-table.table>
                        </div>
                    </x-modal.card>
                </div>
                
            </div>
        </x-card>
    </div>
</div>

