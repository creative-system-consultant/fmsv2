<div>
    <!-- Membership Overview -->
    <div class="mt-6">
        <x-card title="Membership Overview" >
            <x-slot name="action" >
                <div class="flex items-center justify-center space-x-2">
                    <x-button primary label="Close Membership Document" sm wire:click="closeMembership" />
                    <x-button wire:click="editDetail" icon="{{ ($disabled == true) ? 'pencil' : 'x' }}" primary label="{{ ($disabled == true) ? 'Edit' : 'Cancel' }}" sm />
                    @if($disabled == false)
                        <x-button wire:click="saveDetail" icon="save" primary label="Save" sm/>
                    @endif
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-2 md:grid-cols-4">
                <div class="hidden">
                    <x-input label="Client ID" placeholder="" wire:model="client_id" :disabled="true"/>
                </div>
                <div class="hidden">
                    <x-input label="ID" placeholder="" wire:model="id" :disabled="true" />
                </div>
                <div>
                    <x-input label="Member No" placeholder="" wire:model="ref_no" :disabled="true" />
                </div>
                <div>
                    <x-input label="Staff No" placeholder="" wire:model="staff_no" :disabled="true" />
                </div>
                <div>
                    <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled="true" />
                </div>
                <div>
                    <x-input label="Name" placeholder="" wire:model="name" :disabled="true" />
                </div>
                <div>
                    <x-input label="Applied Date" placeholder="" wire:model="apply_date" :disabled="true" />
                </div>
                <div>
                    <x-input label="Joined Date" placeholder="" wire:model="start_date" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="End Date" placeholder="" wire:model="end_date" :disabled="true" />
                </div>
                <div>
                    <x-input label="Entrance Fee" placeholder="" wire:model="entrance_fee" :disabled="true" />
                </div>
                <div>
                    <x-input label="Entrance Fee Date" placeholder="" wire:model="start_date" :disabled="true" />
                </div>
                <div>
                    <x-input label="Membership Status" placeholder="" wire:model="status_id" :disabled="true" />
                </div>
                <div>
                    <x-input label="Status Changed Date" placeholder="" wire:model="status_change_date" :disabled="true" />
                </div>
                <div>
                    <x-native-select label="Payment Type" placeholder="Select Payment Type" :options="$paymentTypeOptions" option-label="name" option-value="id" wire:model="payment_type_id" :disabled=$disabled />
                </div>
                <div>
                    <x-input label="Staff No Payer" placeholder="" wire:model="staffno_payer" :disabled="true" />
                </div>
                <div>
                    <x-input label="Tabung Khairat" placeholder="" wire:model="tkk_amount" :disabled="true" />
                </div>
                <div>
                    <x-input label="Year Tabung Khairat" placeholder="" wire:model="tkk_last_pay_dt" :disabled="true" />
                </div>
                <div>
                    <x-input label="Approved Retirement Date" placeholder="" wire:model="approved_retirement_date" :disabled="true" />
                </div>
                <div>
                    <x-input label="Effective Retirement Date" placeholder="" wire:model="effective_retirement_date" :disabled="true" />
                </div>
                <div>
                    <x-input label="VA Account" placeholder="" wire:model="va_account" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Total Share" placeholder="" wire:model="total_share" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Monthly Share" placeholder="" wire:model="monthly_share" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Purchase Amount" placeholder="" wire:model="last_purchase_amount" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Purchase Date" placeholder="" wire:model="last_purchase_date" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Selling Amount" placeholder="" wire:model="last_selling_amount" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Selling Date" placeholder="" wire:model="last_selling_date" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Total Contribution" placeholder="" wire:model="total_contribution" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Monthly Contribution" placeholder="" wire:model="monthly_contribution" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Payment Amount" placeholder="" wire:model="last_payment_amount" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Payment Date" placeholder="" wire:model="last_payment_date" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Withdraw Amount" placeholder="" wire:model="last_withdraw_amount" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Last Withdraw Date" placeholder="" wire:model="last_withdraw_date" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Total Withdraw Amount" placeholder="" wire:model="total_withdraw_amount" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Type ID" placeholder="" wire:model="type_id" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Data Status" placeholder="" wire:model="data_status" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Created By" placeholder="" wire:model="created_by" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Updated By" placeholder="" wire:model="updated_by" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Deleted By" placeholder="" wire:model="deleted_by" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Created At" placeholder="" wire:model="created_at" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Updated At" placeholder="" wire:model="updated_at" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Retirement Flag" placeholder="" wire:model="retirement_flag" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="No of Contribution Withdrawal" placeholder="" wire:model="no_of_withdrawal" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Source" placeholder="" wire:model="source" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Withdraw Share PV" placeholder="" wire:model="withdraw_share_pv" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Withdraw Con PV" placeholder="" wire:model="withdraw_con_pv" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Kebajikan PV" placeholder="" wire:model="kebajikan_pv" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Khairat PV" placeholder="" wire:model="khairat_pv" :disabled="true" />
                </div>
                <div class="hidden">
                    <x-input label="Closed MBR PV" placeholder="" wire:model="closed_mbr_pv" :disabled="true" />
                </div>

            </div>
        </x-card>
    </div>

    <div class="mt-6">
        <x-card title="Introducer List">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="NAME" sort="" />
                    <x-table.table-header class="text-left" value="MEMBERSHIP NO" sort="" />
                    <x-table.table-header class="text-left" value="IC NO" sort="" />
                    <x-table.table-header class="text-left" value="PAYMENT AMOUNT" sort="" />
                    <x-table.table-header class="text-left" value="PAYMENT DATE" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($introducers as $introducer)
                        <tr>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $introducer->introducer->cifCustomer->name }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $introducer->introducer_mbr_no }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $introducer->introducer_identityno }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $introducer->payment_amount }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                {{ $introducer->payment_date }}
                            </x-table.table-body>
                        </tr>
                        @empty
                            <tr>
                                <x-table.table-body colspan="5" class="text-xs font-medium text-center text-gray-700 ">
                                    <x-no-data title="No data"/>
                                </x-table.table-body>
                            </tr>
                        @endforelse
                </x-slot>
            </x-table.table>
        </x-card>
    </div>
</div>
