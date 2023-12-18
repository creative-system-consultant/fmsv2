<div>
    <div wire:loading wire:target="type_payment_in,type_payment_out">
        @include('misc.loading')
    </div>
    <div x-data="{tab:@entangle('tabIndex')}">
        <x-container title="Teller" routeBackBtn="" titleBackBtn="" disableBackBtn="">
            <div class="grid grid-cols-1">
                <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center ">
                        @foreach($list_tab as $item)
                        <x-tab.title name="{{$item['index']}}" wire:click="{{$item['wireClickFunction']}}">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="{{$item['icon']}}" class="w-5 h-5 mr-2" />
                                <h1>{{$item['label']}}</h1>
                            </div>
                        </x-tab.title>
                        @endforeach
                    </div>
                </div>

                <!-- payment in -->
                <div x-show="tab == 0">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select label="Type of Payment In" placeholder="-- PLEASE SELECT --" minItemsForSearch="1" wire:model.live="type_payment_in">
                                @foreach($option_payment_in as $item)
                                <x-select.option label="{{ $item['value'] }}" value="{{ $item['value'] }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_payment_in == 'Payment Contribution')
                        <livewire:teller.payment-contribution />
                        @elseif($type_payment_in == 'Purchase Share')
                        <livewire:teller.purchase-share />
                        @elseif($type_payment_in == 'Financing Repayment')
                        <livewire:general.teller.common-page module='financingRepayment' searchMthInstallAmt=true searchInstallAmtArear=true searchTotContribution=true />
                        @elseif($type_payment_in == 'Early Settlement Payment')
                        <livewire:general.teller.common-page module='earlySettlementPayment' searchAccNo=true searchBalOutstanding=true searchRebate=true searchSettleProfit=true />

                        @elseif($type_payment_in == 'Third Party')
                        <livewire:general.teller.common-page module='thirdParty' searchMbrNo=true searchInstitute=true searchTrxAmt=true searchModeId=true />

                        @elseif($type_payment_in == 'Miscellaneous in')
                        <livewire:general.teller.common-page module='miscellaneousIn' searchMbrNo=true searchStaffNo=true searchMiscAmt=true />

                        @elseif($type_payment_in == 'Autopay')
                        <livewire:teller.autopay.autopay />

                        @elseif($type_payment_in == 'Early Settlement Overlap')
                        <livewire:teller.settlement-overlap.settlement-overlap />

                        @elseif($type_payment_in == 'Bulk Payment')
                        <livewire:general.teller.common-page module='bulkPayment' />
                        @endif
                    </div>
                </div>

                <!-- payment out -->
                <div x-show="tab == 1">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select label="Type of Payment Out" placeholder="-- PLEASE SELECT --" minItemsForSearch="1" wire:model.live="type_payment_out">
                                @foreach($option_payment_out as $item)
                                <x-select.option label="{{ $item['value'] }}" value="{{  $item['value'] }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_payment_out == 'Withdraw Contribution')
                        <livewire:teller.withdraw-contribution.withdraw-contribution />

                        @elseif($type_payment_out == 'Withdraw Share')
                        <livewire:general.teller.common-page module='withdrawShare' searchMbrNo=true searchTotShare=true />

                        @elseif($type_payment_out == 'Close Membership')
                        <livewire:general.teller.common-page module='closeMembership' searchMbrNo=true searchTotShare=true searchTotContribution=true searchFee=true searchMiscAmt=true searchBalDividen=true searchAdvPayment=true />

                        @elseif($type_payment_out == 'Payment to Members')
                        <livewire:teller.payment-member.payment-member />

                        @elseif($type_payment_out == 'Dividend Withdrawal')
                        <livewire:teller.withdraw-dividen.withdraw-dividen />

                        @elseif($type_payment_out == 'Disbursement')
                        <livewire:teller.disbursement.disbursement-transaction />

                        @elseif($type_payment_out == 'Miscellaneous Out')
                        <livewire:general.teller.common-page module='miscellaneousOut' searchMbrNo=true searchMiscAmt=true />

                        @elseif($type_payment_out == 'Refund Advance')
                        <livewire:general.teller.common-page module='refundAdvance' searchAccNo=true searchAdvPayment=true />
                        @elseif($type_payment_out == 'Dividen Approval')
                        <livewire:teller.dividen-approval.dividen-approval />

                        @elseif($type_payment_out == 'Dividen Batch Widthdrawal')
                        <livewire:teller.dividen-batch.dividen-batch />

                        @elseif($type_payment_out == 'Transfer Share')
                        <livewire:teller.transfer-share.transfer-share />

                        @endif
                    </div>
                </div>
            </div>
        </x-container>
    </div>
</div>
