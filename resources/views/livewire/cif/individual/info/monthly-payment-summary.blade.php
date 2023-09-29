<div>
    <x-card title="Montly Payment Summary" >
        <div>
            
            <x-table.table>
                
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="DEDUCTION" sort="" />
                    <x-table.table-header class="text-right" value="AUTOPAY" sort="" />
                    <x-table.table-header class="text-right" value="MONTHLY" sort="" />
                    
                </x-slot>
                <x-slot name="tbody">
                   
                    <tr>
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

