

<div>
    <x-container title="Religions Maintenance" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <a href="{{ route('religion.create') }}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
        
                Create
            </a>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="NO." sort="" />
                    <x-table.table-header class="text-left" value="RELIGION NAME" sort="" />
                    <x-table.table-header class="text-left" value="CODE" sort="" />
                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">

                 @foreach ($RefReligion as $religion)
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            {{ $loop->iteration }}
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            {{ $religion->description }}
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            {{ $religion->code }} 
                        </x-table.table-body>

                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            {{ $religion->status == 1 ? 'ENABLE':'DISABLE' }}
                        </x-table.table-body>
            
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <a href="{{ route('religion.edit',$religion->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                Edit
                            </a>
                            

                            <button
                                wire:click="delete({{$religion->id}})",
                                class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400">
                                Delete
                            </button>
                            
                           </x-table.table-body>
                    </tr>
                    @endforeach
                
                </x-slot>
            </x-table.table>



        </div>
    </x-container>
</div>

