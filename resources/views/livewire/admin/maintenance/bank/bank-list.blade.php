<div>
    <x-container title="Bank List" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <x-button 
                class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400"
                href="{{ route('bank.create') }}"
                label="Create"
            />
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="No." sort="" />
                    <x-table.table-header class="text-left" value="Description" sort="" />
                    <x-table.table-header class="text-left" value="Code" sort="" />
                    <x-table.table-header class="text-left" value="Status" sort="" />
                    <x-table.table-header class="text-left" value="Action" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($Bank as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $loop->iteration }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->description }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->code }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $item->status == 1 ? 'Enable':'Disable'}}
                            </x-table.table-body>

                            <x-table.table-body colspan="1" class="text-left"  x-data="{deleteModal:false}">
                                <a href="{{ route('bank.edit',$item->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                    Edit
                                </a>

                                <x-button wire:click="delete({{ $item->id }})" squared negative label="Delete"/>
                                       
                            </x-table.table-body>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table.table>

          

        </div>
    </x-container>
</div>
