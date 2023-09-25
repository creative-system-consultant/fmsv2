

<div>
    <x-container title="Member Info" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
           
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="NO." sort="" />
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-left" value="CODE" sort="" />
                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                    <x-table.table-header class="text-left" value="VIEW" sort="" />
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
                            <a href="{{ route('info') }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                Review
                            </a>
                            
                           </x-table.table-body>
                    </tr>
                
                
                </x-slot>
            </x-table.table>



        </div>
    </x-container>
</div>

