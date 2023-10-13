<div>
    <x-container title="Member Info" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="grid grid-cols-1">
            <div class="flex items-center space-x-2">
                <x-label label="Search :"/>
                <div>
                    <x-native-select  wire:model="model">
                        <option value="name">Name</option>
                        <option value="identity_no">Identity No</option>
                        <option value="ref_no">Membership Id</option>
                        <option value="staff_no">Staff No</option>
                    </x-native-select>
                </div>

                <div class="w-64">
                    <x-input 
                        wire:model.live="search"
                        placeholder="Search"
                    />
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <x-table.table loading="true" loadingtarget="search">
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="NO" sort="" />
                        <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                        <x-table.table-header class="text-left" value="MEMBERSHIP ID" sort="" />
                        <x-table.table-header class="text-left" value="IC NUMBER" sort="" />
                        <x-table.table-header class="text-left" value="NAME" sort="" />
                        <x-table.table-header class="text-left" value="STATUS" sort="" />
                        <x-table.table-header class="text-left" value="APPROVED DATE" sort="" />
                        <x-table.table-header class="text-left" value="UPDATE DATE" sort="" />
                        <x-table.table-header class="text-left" value="ACTION" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($customers as $item)
                            <tr>
                                <x-table.table-body colspan="" class="text-center text-gray-500">
                                    <p>{{ (($customers ->currentpage()-1) * $customers ->perpage()) + $loop->index + 1 }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{$item->staff_no}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{$item->ref_no}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{$item->identity_no}}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{$item->name}}</p>
                                </x-table.table-body>
                                
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{ $item->status_id ?  ($item->status_id ==1 ? 'Active' :'Inactive') : 'N/A' }}</p>
                                </x-table.table-body>
                                
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{ $item->created_at ?  date('d/m/Y', strtotime($item->created_at)) : 'N/A' }}</p>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left text-gray-500">
                                    <p>{{ $item->updated_at ?  date('d/m/Y', strtotime($item->updated_at)) : 'N/A' }}</p>
                                </x-table.table-body>
                                
                                <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                    <div class="flex items-center space-x-2">
                                        <x-button sm  href="{{ route('cif.info',['uuid'=>$item->uuid]) }}" icon="eye" primary label="CIF" wire:navigate/>
                                        <x-button sm  href="{{ route('cif.member',['uuid'=>$item->uuid]) }}" icon="eye" primary label="Membership" wire:navigate/>
                                    </div>
                                </x-table.table-body>

                            </tr>
                            @empty
                            <x-table.table-body colspan="10" class="font-medium text-center text-gray-900">
                                <p><center>No data</center></p>
                            </x-table.table-body>
                            @endforelse
                            
                    </x-slot>
                    
                </x-table.table>
                <div class="px-2 py-2 mt-4">
                    {{ $customers->links('livewire::pagination-links') }}
                </div>
            </div>
            
        </div>
    </x-container>
</div>

