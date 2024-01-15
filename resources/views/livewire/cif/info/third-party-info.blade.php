<div>
    <x-card title="Third Party Information">
        <x-slot name="action">
            <x-button wire:click="openCreateThirdPartyModal" icon="plus" primary label="Create" sm />
        </x-slot>
        <! -- start create third party modal -->
        <x-modal.card  title="{{ $modalTitle }} Third Party" align="center"  wire:model.defer="thirdPartyModal">
            <div class="grid grid-cols-2 gap-4">
                <x-native-select label="Mode" wire:model.live="mode" >
                    <option hidden>Please Choose</option>
                    <option value="1">One Of Payment</option>
                    <option value="2">No Expiry</option>
                    <option value="3">Period</option>
                </x-native-select>

                <x-native-select label="Description" wire:model="institution_code" >
                    <option hidden>Please Choose</option>
                    @foreach ($RefThirdParty as $type)
                        <option value="{{ $type->id }}">{{ $type->description }}</option>
                    @endforeach
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

                <div class="{{ $mode == 3 ? 'show' : 'hidden' }}">
                    <x-input
                        label="Expiry Date"
                        type="date"
                        wire:model="expiry_dt"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4">
                <x-textarea
                    label="Remarks"
                    wire:model="remarks"
                />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="{{ $modalSubmit }}" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
        <! -- end create third party modal -->

        <div class="grid grid-cols-1 mt-2">
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
                                <x-button wire:click="statement({{ $item->id }})" primary label="Statement" sm />
                                <x-button wire:click="openUpdateThirdPartyModal({{ $item->id }})" warning label="Edit" sm />
                                <x-button wire:click="delete({{ $item->id }})" negative label="Delete" sm/>
                            </x-table.table-body>
                        </tr>
                    @empty
                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                            <x-no-data title="No data"/>
                        </x-table.table-body>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
    </x-card>

    <x-modal.card title="statement Info" align="center" max-width="8xl" blur wire:model.defer="thirdPartyModalStatement">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <x-datetime-picker
                    label="Start Date"
                    wire:model="startDate"
                    without-time=true
                    display-format="DD/MM/YYYY"
                />
                <x-datetime-picker
                    label="End Date"
                    wire:model="startDate"
                    without-time=true
                    display-format="DD/MM/YYYY"
                />
            </div>
            <div class="flex items-center space-x-2">
                <x-button
                    sm
                    icon="document-report"
                    green
                    label="Excel"
                    wire:click=""
                />
                <x-button
                    sm
                    icon="document-report"
                    orange
                    label="Pdf"
                    wire:click=""
                />
            </div>
        </div>
        <div class="mt-4">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="TRANSACTION AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="PAYMENT MODE" sort="" />
                    <x-table.table-header class="text-left" value="TOTAL AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="TRANSACTION DATE" sort="" />
                    <x-table.table-header class="text-left" value="REMARKS" sort="" />
                    <x-table.table-header class="text-left" value="CREATED BY" sort="" />
                    <x-table.table-header class="text-left" value="CREATED AT" sort="" />
                    <x-table.table-header class="text-left" value="ACTION" sort="" />
                    
                
                </x-slot>
                <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>10.00</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>Payment by Salary Deductions</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                <p>10.00</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>31/01/2022</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>JAN 22 - CIMB</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>N/A</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <p>21/05/202212:05:00</p>
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                <div class="flex items-center justify-center">
                                    <x-button
                                        xs
                                        icon="document-report"
                                        primary
                                        label="RECEIPT"
                                        wire:click=""
                                    />
                                </div>
                            </x-table.table-body>
                        </tr>
                </x-slot>
            </x-table.table>
        </div>
    </x-modal.card>
</div>
