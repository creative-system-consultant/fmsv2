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
                                class="text-xs lg:text-sm form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-md shadow-sm py-1 px-4"
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
                        <div class="flex items-center pr-2 mt-1 rounded-md sm:pr-0">
                                <x-button 
                                    sm  
                                    icon="clipboard-check"
                                    primary 
                                    label="Calculate" 
                                    wire:click="instalmentRes"
                                />
                            </button>
{{-- 
                            @if($financeInfoNew)
                                <div class="flex ml-4 space-x-2">
                                    <div>
                                        <x-general.button.icon
                                            href="#"
                                            target=""
                                            label="View New Schedule"
                                            color="orange"
                                            livewire=""
                                            class=""
                                            @click="viewOpen = true"
                                        >
                                            <x-heroicon-o-eye class="-ml-0.5 mr-2 h-4 w-4"/>
                                        </x-general.button.icon>
                                    </div>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                @endif
                    
                    
                </div>
            </x-card>
        </div>
    </div>
</div>

