<div>
    <div class=" grid grid-cols-1">
        <x-card title="Account Position Details" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Disbursed Amount" 
                    wire:model=""
                    value="{{number_format($account_position->disbursed_amount,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Undrawn Amount" 
                    wire:model=""
                    value="{{number_format($account_position->undrawn_amount,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Report Date" 
                    wire:model=""
                    value="{{isset($account_position->report_date) ? date('d/m/Y',strtotime($account_position->report_date)) : ''}}"
                    disabled
                />
                <x-input 
                    label="Balance Outstanding" 
                    wire:model=""
                    value="{{number_format($account_position->bal_outstanding,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Principal Outstanding" 
                    wire:model=""
                    value="{{number_format($account_position->prin_outstanding,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Profit Outstanding" 
                    wire:model=""
                    value="{{number_format($account_position->uei_outstanding,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Payment Earned" 
                    wire:model=""
                    value="{{number_format($account_position->payment_amount,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Principal Earned" 
                    wire:model=""
                    value="{{number_format($account_position->princp_collected,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Selling Price" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Payment Term" 
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Profit Rate" 
                    value=""
                    wire:model=""
                    disabled
                />
                <x-input 
                    label="Profit Earned" 
                    wire:model=""
                    value="{{number_format($account_position->tot_profit_earned,2,'.',',')}}"
                    disabled
                />

                <x-input 
                    label="Instalment No" 
                    wire:model=""
                    value="{{$account_position->instalment_no}}"
                    disabled
                />
                <x-input 
                    label="Month in Arrears" 
                    wire:model=""
                    value="{{number_format($account_position->month_arrears,2,'.',',')}}"
                    disabled
                />
                <x-input 
                    label="Instalment Arrears" 
                    wire:model=""
                    value="{{number_format($account_position->instal_arrears,2,'.',',')}}"
                    disabled
                />

                <x-input 
                    label="Advance Payment" 
                    wire:model=""
                    value="{{number_format($account_position->advance_payment,2,'.',',')}}"
                    disabled
                />

                <x-input 
                    label="Last Payment Date" 
                    wire:model=""
                    value="{{isset($account_position->last_payment_date) ? date('d/m/Y',strtotime($account_position->last_payment_date)) : ''}}"
                    disabled
                />

                <x-input 
                    label="Last Instalment Date" 
                    wire:model=""
                    value="{{isset($account_position->last_instal_date) ? date('d/m/Y',strtotime($account_position->last_instal_date)) : ''}}"
                    disabled
                />

                <x-input 
                    label="Last Instalment Due Date" 
                    wire:model=""
                    value="{{isset($account_position->last_instal_due_date) ? date('d/m/Y',strtotime($account_position->last_instal_due_date)) : ''}}"
                    disabled
                />
            </div>
        </x-card>
    </div>
</div>

