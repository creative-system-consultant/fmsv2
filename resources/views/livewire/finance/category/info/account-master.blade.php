<div>
    <div class=" grid grid-cols-1">
        <x-card title="Account Master Details" >
            <x-slot name="action" >
                <div class="flex items-center justify-center space-x-2">
                    <x-button primary label="Payment Voucher" sm />
                    <x-button primary label="Print" sm />
                    <x-button wire:click="editDetail" icon="pencil" primary label="Edit" sm />
                    <x-button icon="save" primary label="Save" sm/>
                </div>
            </x-slot>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Account No" 
                    wire:model=""
                    value="{{$account->account_no}}"
                    disabled
                />
                <x-input 
                    label="Product Name" 
                    wire:model=""
                    value="{{$account->product}}"
                    disabled
                />
                <x-input 
                    label="Product Concept" 
                    wire:model=""
                    value="{{optional($account->concept)->description}}"
                    disabled
                />
                <x-input 
                    label="Approved Amount" 
                    wire:model=""
                    value="{{number_format($account->approved_limit,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Approved Date" 
                    wire:model=""
                    value="{{date('d/m/Y',strtotime($account->approved_date))}}"
                    disabled
                />
                <x-input 
                    label="Apply Date" 
                    wire:model=""
                    value="{{date('d/m/Y',strtotime($account->apply_date))}}"
                    disabled
                />
                <x-input 
                    label="Duration (Month)" 
                    wire:model=""
                    value="{{$account->duration}}"
                    disabled
                />
                <x-input 
                    label="Purchased Price" 
                    wire:model=""
                    value="{{number_format($account->purchase_price,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Selling Price" 
                    wire:model=""
                    value="{{number_format($account->selling_price,2,'.',',')}}"
                    disabled
                />

                <x-native-select label="Payment Term" wire:model=""  disabled>
                    <option value="m">Monthly</option>
                </x-native-select>

                <x-input 
                    label="Profit Rate" 
                    value="{{number_format($account->profit_rate,2,'.',',')}}%"
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Instalment Amount" 
                    wire:model=""
                    value="{{number_format($account->instal_amount,2,'.',',')}}"
                    disabled
                />

                <x-native-select label="Account Status"  wire:model="" disabled>
                    @forelse ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->description }}</option>
                    @empty @endforelse
                </x-native-select>

                <x-input 
                    label="Start Disbursed Date" 
                    wire:model=""
                    value="{{date('d/m/Y',strtotime($account->start_disbursed_date))}}"
                    disabled
                />
                <x-input 
                    label="Account Status Changed Date" 
                    wire:model=""
                    value="{{isset($account->acct_stat_chg_date) ? date('d/m/Y',strtotime($account->acct_stat_chg_date)): ''}}"
                    disabled
                />
                <x-input 
                    label="Start Instalment Date" 
                    wire:model=""
                    value="{{date('d/m/Y',strtotime($account->start_instal_date))}}"
                    disabled
                />

                <x-native-select label="Payment Type"  wire:model="" disabled>
                    @forelse ($payment_types as $payment_type)
                        <option value="{{ $payment_type->id }}" selected>{{ $payment_type->description }}</option>
                    @empty @endforelse
                </x-native-select>

                <x-input 
                    label="Reschedule Status" 
                    wire:model=""
                    value="{{ $account->reschedule_flag == 'Y' ? 'YES' : 'NO' }}"
                    disabled
                />

                <div class="flex items-center">
                    <div class="w-full">
                        <x-input 
                            label="Payer Staff No." 
                            wire:model=""
                            disabled
                        />
                    </div>
                    <div class="mt-6 ml-2">
                        <x-button 
                            onclick="$openModal('search-modal')"
                            icon="search" 
                            primary 
                            label="Search" 
                            sm
                        />
                    </div>

                    <x-modal.card title="Search Payer" align="center" max-width="6xl" blur wire:model.defer="search-modal">
                        <div class="grid grid-cols-1 sgap-4">
                            <div class="flex items-center space-x-2 mb-4">
                                <x-label label="Search :"/>
                                <div>
                                    <x-native-select  wire:model="model">
                                        <option value="">Name</option>
                                        <option value="">Identity No</option>
                                        <option value="">Membership Id</option>
                                        <option value="">Staff No</option>
                                    </x-native-select>
                                </div>
                
                                <div class="w-64">
                                    <x-input 
                                        wire:model="search"
                                        placeholder="Search"
                                    />
                                </div>
                            </div>
                            <x-table.table>
                                <x-slot name="thead">
                                    <x-table.table-header class="text-left" value="IDENTITY NO" sort="" />
                                    <x-table.table-header class="text-left" value="STAFF NO" sort="" />
                                    <x-table.table-header class="text-left" value="NAME" sort="" />
                                    <x-table.table-header class="text-left" value="STATUS" sort="" />
                                    <x-table.table-header class="text-left" value="Action" sort="" />
                                </x-slot>
                                <x-slot name="tbody">
                                    <tr>
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            
                                        </x-table.table-body>
                
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>
                                    
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>

                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                        
                                        </x-table.table-body>
                
                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                            <x-button 
                                                x-on:click="close"
                                                sm  
                                                icon="plus" 
                                                primary 
                                                label="Select" 
                                            />
                                        </x-table.table-body>
                                    </tr>
                                </x-slot>
                            </x-table.table>
                        </div>
                    </x-modal.card>
                </div>
                
            </div>
        </x-card>
    </div>
</div>

