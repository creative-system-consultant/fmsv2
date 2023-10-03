<div>
    <x-card title="Dividend Statements" >
        <div class="flex items-center justify-between mb-4">
            <x-input 
                label="Qualified Dividend" 
                placeholder="RM 0.00"
                disabled
                wire:model="" 
            />
        
            <div class="flex gap-6">
                <div class="flex items-center space-x-2">
                    <x-input type="date"  label="Start Date" value="" wire:model=""/>
                    <x-input type="date"  label="End Date" value="" wire:model=""/>

                    <div class="mt-6">
                        <x-button sm icon="document-report" green label="Excel"/>
                        <x-button sm icon="document-report" orange label="PDF" />
                    </div>
                </div>
            </div>
                
        </div>

            <x-table.table>
                
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DESCRIPTION" sort="" />
                    <x-table.table-header class="text-left" value="DOCUMENT NO" sort="" />
                    <x-table.table-header class="text-left" value="AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="TOTAL AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="REMARKS" sort="" />
                    

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
                    </tr>
                </x-slot>
            </x-table.table>

        </div>
    </x-card>
</div>

