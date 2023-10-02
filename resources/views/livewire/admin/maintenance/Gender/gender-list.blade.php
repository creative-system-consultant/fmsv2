<div>
    <h1 class="text-base font-semibold md:text-2xl"></h1>
    <x-container title="Gender Information" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="NO." sort="" />
                    <x-table.table-header class="text-left" value="GENDER NAME" sort="" />
                    <x-table.table-header class="text-left" value="CODE" sort="" />
                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($RefGender as $gender)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $loop->iteration }}
                            </x-table.table-body>
                
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $gender->description }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $gender->code }}
                            </x-table.table-body>

                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $gender->status == 1 ? 'ENABLE' : 'DISABLE' }}
                            </x-table.table-body>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table.table>
        </div>
    </x-container>
</div>
