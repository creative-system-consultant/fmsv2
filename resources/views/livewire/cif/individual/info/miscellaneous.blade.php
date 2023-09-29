<div>
    <x-card title="Miscellaneous Info" >
        <div class="flex mt-1 mb-2 rounded-md gap-3">
            <x-input wire:model="" label="Total" placeholder="RM 0.00" class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3"/>
            <x-input wire:model="" label="Last Payment Amount" placeholder="RM 0.00" class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3"/>
            <x-input wire:model="" label="Last Withdrawal Amount" placeholder="RM 0.00" class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3"/>
            <x-input wire:model="" label="Last Payment Date" placeholder="" class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3"/>
            <x-input wire:model="" label="Last Withdrawal Date" placeholder="" class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3"/>
            
        </div>
        </x-card>

    <br>
    <br>
    <br>


    <x-card title="Miscellaneous Statement" >
        <div>
            <x-slot name="action">
                <div class="text-right">
                    <x-button squared primary label="Excel" />
                    <x-button squared primary label="PDF" />
                </div>
            </x-slot>
            
            <div class="flex gap-6">
                <div>
                    <x-label class="block text-sm font-semibold leading-5 text-gray-700" label="Start Date"/>
                    <input type="date" value="" id="name=" class="flex mt-1 mb-2 rounded-md lg:text-sm form-input py-1  px-4">
                </div>
                
                <div>
                    <x-label class="block text-sm font-semibold leading-5 text-gray-700" label="End Date"/>
                    <input type="date" value="" id="name=" class="flex mt-1 mb-2 rounded-md lg:text-sm form-input py-1 px-4" >
                </div>
            </div>
            <br>
            <br>
            
            <x-table.table style="width:100%">
                
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION  DATE" sort="" />
                    <x-table.table-header class="text-left" value="DOCUMENT NO" sort="" />
                    <x-table.table-header class="text-left" value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="TOTAL AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="REMARKS" sort="" />
                    <x-table.table-header class="text-left" value="CREATED BY" sort="" />
                    <x-table.table-header class="text-left" value="CREATED AT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />


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
                           
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                           
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                           
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                           
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                           
                        </x-table.table-body>
                        

                       
                    </tr>
                    <x-table.table-body colspan="7" class="font-medium text-center text-gray-900">
                        <p>No data</p>
                    </x-table.table-body>
                 
                </x-slot>
            </x-table.table>

       </div>
    </x-card>

</div>


