<div>
    <x-card title="View Details Exception">
        <div class="flex items-center justify-between mb-5">
            <div class="flex flex-col space-y-2 sm:items-center sm:space-x-2 sm:flex-row">
                <x-label label="Search :" class="mt-2"/>
                <div class="w-full sm:w-64">
                    <x-input wire:model.lazy="search" placeholder="Search" />
                </div>
            </div>
            <x-button
                sm
                icon="paper-airplane"
                green
                label="Submit"
                wire:click=""
            />
        </div>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                <x-table.table-header class="text-left" value="MEMBER NO" sort="" />
                <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                <x-table.table-header class="text-left" value="NAME" sort="" />
                <x-table.table-header class="text-left" value="ACCOUNT NO" sort="" />
                <x-table.table-header class="text-left" value="CATEGORY" sort="" />
                <x-table.table-header class="text-right" value="INSTALMENT AMOUNT" sort="" />
                <x-table.table-header class="text-right" value="PAYMENT AMOUNT" sort="" />
                <x-table.table-header class="text-center" value="DOCUMENT NO" sort="" />
                <x-table.table-header class="text-right" value="THIRDPARTY MODE" sort="" />
                <x-table.table-header class="text-center" value="THIRDPARTY ID" sort="" />
                <x-table.table-header class="text-center" value="CODE" sort="" />
                <x-table.table-header class="text-center" value="STATUS" sort="" />
                <x-table.table-header class="text-right" value="NEW AMOUNT" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($data as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                            <p>{{$item->staffno}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->mbr_no}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->identity_no}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->name}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->account_no}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{$item->category}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700">
                            <p>{{ number_format($item->instalment_amt,2)}}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                            <p>{{ number_format($item->payment_amount,2) }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <p>{{ $item->doc_no }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                            <p>{{ $item->thirdparty_mode }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                            <p>{{ $item->id_thirdparty }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                            <p>{{ $item->code }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                            <p>
                                @if($item->action_status == 'U')
                                    Update
                                @elseif($item->action_status == 'D')
                                    Delete
                                @else
                                    &nbsp;
                                @endif
                            </p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-right text-gray-700 ">
                            <p>{{ number_format($item->new_amount,2) }}</p>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                            <div class="flex items-center space-x-2">
                                <x-button
                                    xs
                                    icon="pencil-alt"
                                    primary
                                    label="Edit"
                                    onclick="$openModal('edit-details-exception')"
                                />
                                <x-button
                                    wire:click=""
                                    xs
                                    icon="trash"
                                    red
                                    label="Delete"
                                />
                            </div>
                        </x-table.table-body>
                    </tr>
                @empty
                    <tr>
                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                            <x-no-data title="No data"/>
                        </x-table.table-body>
                    </tr>
                @endforelse
            </x-slot>
        </x-table.table>


        <!-- modal -->
        <x-modal.card title="Edit Exception Details" align="center" blur wire:model.defer="edit-details-exception" max-width="lg" hide-close="true">
            <div class="grid gap-4 my-2 lg:grid-cols-1 ">
                <x-input
                    wire:model=""
                    label="New Amount"
                    placeholder=""
                    class="uppercase"
                />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <div class="flex">
                        <x-button primary label="Update" wire:click="" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
        <!-- end modal -->
    </x-card>
</div>
