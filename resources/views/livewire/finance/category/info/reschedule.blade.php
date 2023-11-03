<div>
    <div class=" grid grid-cols-1">
        <x-card title="Financing Details as at {{now()->format('d/m/Y')}}" >

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            {{-- @foreach ($financeInfo as $item) --}}

                <x-input 
                    label="Balance Outstanding (RM)" 
                    wire:model=""
                    value="{{number_format($financeInfo->bal_outstanding,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Principal Outstanding (RM)" 
                    wire:model=""
                    value="{{number_format($financeInfo->prin_outstanding,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Income Outstanding (RM)" 
                    wire:model=""
                    value="{{number_format($financeInfo->uei_outstanding,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Instalment Amount (RM)" 
                    wire:model=""
                    value="{{number_format($financeInfo->instal_amount,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Instalment No. (Paid)" 
                    wire:model=""
                    value="{{$financeInfo->instalment_no}}"
                    disabled
                />
                <x-input 
                    label="Duration (Month)" 
                    wire:model=""
                    value="{{$financeInfo->duration}}"
                    disabled
                />
                <x-input 
                    label="Month in Arrears" 
                    wire:model=""
                    value="{{$financeInfo->month_arrears}}"
                    disabled
                />
                <x-input 
                    label="Balance Duration (Month)" 
                    wire:model=""
                    value="{{$financeInfo->balance_duration}}"
                    disabled
                />
                {{-- @endforeach --}}

            </div>
        </x-card>

        <div class="mt-6">
            <x-card title="Reschedule" >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <x-input 
                        label="Date of Birth" 
                        wire:model=""
                        value="{{date('d/m/Y',strtotime($financeInfo->birth_date))}}"
                        disabled
                    />
                    <x-input 
                        label="Maximum Duration Allowed (Month)" 
                        wire:model=""
                        value="{{$view_minamt_dur[0]->max_dur}}"
                        disabled
                    />
                    <x-input 
                        label="Minimum Instalment Amount Allowed (RM)" 
                        wire:model=""
                        value="{{number_format($view_minamt_dur[0]->min_amt,2,'.',',')}}"
                        disabled
                    />

            

                    {{-- <x-native-select label="Reschedule Mode"  wire:model="reschedule" >
                        <option value="">Please Select</option>
                        <option value="ins">Instalment Amount (RM)</option>
                        <option value="dur">Instalment Duration (Month)</option>
                    </x-native-select> --}}

                    <div class="" >
                            <label class="block text-sm font-semibold leading-5 text-gray-700">
                                Reschedule Mode
                            </label>
                        <div class="mt-1 mb-4">
                            <select 
                                wire:model.lazy="reschedule"
                                id="reschedule"
                                name="reschedule"
                                class="select-custom"
                                wire:loading.attr='readonly'
                                wire:loading.class="bg-gray-300"
                                wire:target="submit"
                            >
                                <option value="" hidden>Please choose</option>
                                <option value="ins">Instalment Amount (RM)</option>
                                <option value="dur">Instalment Duration (Month)</option>
                            </select>
                        </div>
                    </div>
                    
                {{-- {{$reschedule}} --}}
                @if ($reschedule =='ins' || $reschedule =='dur' )
                    <div class="">
                        <x-input 
                        label="{{$reschedule =='ins' ? 'Add New Instalment Amount (RM)' : 'Additional Duration (Months)'}}" 
                        wire:model="newInstalAmt"
                        disabled
                    />
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center pr-2 mt-1 rounded-md sm:pr-0 space-x-2">
                            <x-button 
                                sm  
                                icon="clipboard-check"
                                primary 
                                label="Calculate" 
                                wire:click="instalmentRes"
                            />
                            <x-button 
                                sm  
                                icon="eye"
                                orange 
                                label="View New Schedule" 
                                onclick="$openModal('openSchedule')"
                            />
                        </div>

                        <x-modal.card title="Rescheduled - Repayment Schedule" align="center" blur wire:model.defer="openSchedule" max-width="8xl">
                            <div>
                                <div class="flex items-center justify-end mb-4">
                                    <x-button 
                                        sm 
                                        icon="document-report" 
                                        green 
                                        label="Excel"
                                        wire:click="generateExcel" 
                                    />
                                </div>
                                <x-table.table>
                                    <x-slot name="thead">
                                        <x-table.table-header class="text-left" value="INSTALMENT NO." sort="" />
                                        <x-table.table-header class="text-left" value="INSTALMENT DATE" sort="" />
                                        <x-table.table-header class="text-right" value="INSTALMENT AMOUNT" sort="" />
                                        <x-table.table-header class="text-right" value="BALANCE OUTSTANDING" sort="" />
                                        <x-table.table-header class="text-right" value="PRINT AMOUNT" sort="" />
                                        <x-table.table-header class="text-right" value="PRINCIPAL OUTSTANDING" sort="" />
                                        <x-table.table-header class="text-right" value="PROFIT AMOUNT" sort="" />
                                        <x-table.table-header class="text-right" value="UEI OUTSTANDING" sort="" />
                                    </x-slot>
                                    <x-slot name="tbody">
                                        <tr>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                <p>113</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                <p>30/11/2023</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                                <p>4,060.00</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                                <p>0.00</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                                <p>4,033.00</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                                <p>-94.48</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                                <p>27.00</p>
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 text-right">
                                                <p>94.48</p>
                                            </x-table.table-body>
                                        </tr>
                                    </x-slot>
                                </x-table.table>
                            </div>
                            <x-slot name="footer">
                                <div class="flex justify-end">
                                    <div class="flex">
                                        <x-button icon="check" primary label="Confirm Reschedule" wire:click="" />
                                    </div>
                                </div>
                            </x-slot>
                        </x-modal.card>
                    </div>
                @endif
                </div>
            </x-card>
        </div>
    </div>
</div>

