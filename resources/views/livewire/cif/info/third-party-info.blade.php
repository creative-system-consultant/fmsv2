<div>
    <x-card title="Third Party Information">
        <x-slot name="action">
            <x-button onclick="$openModal('create-tp')" icon="plus" primary label="Create" sm />
        </x-slot>
        <! -- start create third party modal -->
        <x-modal.card  title="Create Third Party" align="center"  wire:model.defer="create-tp">
            <div class="grid grid-cols-2 gap-4">
                <x-native-select label="Mode" wire:model="" >
                    <option value="1">One Of Payment</option>
                    <option value="2">No Expiry</option>
                    <option value="3" x-hide:selected="selected === '3'">Period</option>
                </x-native-select>

                <x-native-select label="Description" wire:model="institution_code" >
                    @forelse ($RefThirdParty as $type)
                    <option value="{{ $type->id }}">{{ $type->description }}</option>
                    @empty @endforelse
                </x-native-select>

                <x-input 
                    label="Trasaction Amount"
                    wire:model="transaction_amt"
                />

                <x-input 
                    label="Priority"
                    wire:model="priority"
                />

                <x-input 
                    label="Effective Date"
                    type="date"
                    wire:model="status_effective_dt"
                />

                <x-input 
                    label="Expiry Date"
                    type="date"
                    wire:model="expiry_dt"
                />
            </div>
            <div class="grid grid-cols-1 mt-4">
                <x-textarea 
                    label="Remarks" 
                    wire:model=""  
                />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
        <! -- end create third party modal -->

        <div class="grid grid-cols-1  mt-2">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="INSTITUTION ID" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="EFECTIVE DATE" sort="" />
                    <x-table.table-header class="text-left " value="EXPIRY DATE" sort="" />
                    <x-table.table-header class="text-left " value="PRIORITY" sort="" />
                    <x-table.table-header class="text-left " value="PAYMENT MODE" sort="" />
                    {{-- <x-table.table-header class="text-left " value="REMARKS" sort="" /> --}}
                    <x-table.table-header class="text-left " value="STATUS" sort="" />
                    {{-- <x-table.table-header class="text-left " value="CREATED BY" sort="" /> --}}
                    {{-- <x-table.table-header class="text-left " value="CREATED AT" sort="" /> --}}
                    <x-table.table-header class="text-left " value="Action" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse($ThirdPartys as $item)

                    <tr>
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{optional($item->institution)->description}}</p>

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ number_format($item->transaction_amt, 2) }}</p>

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ date('d/m/Y', strtotime($item->status_effective_dt)) }}</p>

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $item->expiry_dt ?  date('d/m/Y', strtotime($item->expiry_dt)) : 'N/A' }} </p>

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>{{ $item->priority }}</p>

                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        <p>
                            @if($item->mode == '1')
                                One Of Payment
                            @elseif($item->mode == '2')
                                No Expiry
                            @elseif($item->mode == '3')
                                Period
                            @endif
                        </p>

                    </x-table.table-body>

                    {{-- <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body> --}}

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        @if($item->status == '1')
                            ACTIVE
                        @elseif($item->status == '2')
                            CLOSED
                        @elseif($item->status == '3')
                            FREEZE
                        @endif
                    </x-table.table-body>

                    {{-- <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body>

                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                        N/A
                    </x-table.table-body> --}}


                    <x-table.table-body colspan="1" class="text-left">
                        <x-button  primary label="Statement" sm />
                        <x-button  onclick="$openModal('edit-tp')" warning label="Edit" sm />
                        <x-button  negative label="Delete" sm/>
                    </x-table.table-body>

                    </tr>
                    @empty
                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-center ">
                        <x-no-data title="No data"/>
                    </x-table.table-body>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </x-card>
    <! -- start edit third party modal -->
    <x-modal.card  title="Edit Third Party" align="center"  wire:model.defer="edit-tp">
        <div class="grid grid-cols-2 gap-4">
            <x-native-select label="Mode" wire:model="" >
                <option></option>
            </x-native-select>

            <x-native-select label="Description" wire:model="" >
                <option></option>
            </x-native-select>

            <x-input 
                label="Trasaction Amount"
                wire:model=""
            />

            <x-input 
                label="Priority"
                wire:model=""
            />

            <x-input 
                label="Effective Date"
                type="date"
                wire:model=""
            />

            <x-input 
                label="Expiry Date"
                type="date"
                wire:model=""
            />
        </div>
        <div class="grid grid-cols-1 mt-4">
            <x-textarea 
                label="Remarks" 
                wire:model=""  
            />
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    <! -- end edit third party modal -->
    
</div>
