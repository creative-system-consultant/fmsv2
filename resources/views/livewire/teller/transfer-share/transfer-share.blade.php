<div>
    <div class="grid grid-cols-1">
        <div class="flex items-center space-x-2">
            <x-label label="Search :" />
            <div class="w-64">
                <x-input wire:model="search" placeholder="sellerid/buyer id" />
            </div>
        </div>

        <div style="margin-top: 30px;">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="ID" sort="" />
                    <x-table.table-header class="text-left" value="SELLER MEMBER ID" sort="" />
                    <x-table.table-header class="text-left" value="SELLER NAME" sort="" />
                    <x-table.table-header class="text-left" value="BUYER MEMBER ID" sort="" />
                    <x-table.table-header class="text-left" value="BUYER NAME" sort="" />
                    <x-table.table-header class="text-left" value="TRANSFER AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="APPROVE DATE" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse($datas as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->id}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->seller_no}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->seller->name}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->cust_id }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->buyer->name}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ number_format($item->share_approved, 2) }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ date('d-m-Y', strtotime($item->approval_at)) }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <x-button sm icon="switch-horizontal" primary label="Transfer" />
                        </x-table.table-body>
                    </tr>
                    @empty
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>

    </div>
</div>
