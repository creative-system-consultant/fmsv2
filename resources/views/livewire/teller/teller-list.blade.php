<div>
    <div wire:loading wire:target="type_payment_in,type_payment_out">
        @include('misc.loading')
    </div>
    <div x-data="{tab:0}">
        <x-container title="Teller" routeBackBtn="" titleBackBtn="" disableBackBtn="">
            <div class="grid grid-cols-1">
                <div class="flex mb-4 bg-white rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center ">
                        <x-tab.title name="0" wire:click="clearPaymentOut">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="login" class="w-5 h-5 mr-2"/>
                                <h1>Payment In</h1>
                            </div>
                        </x-tab.title>
                        <x-tab.title name="1" wire:click="clearPaymentIn">
                            <div class="flex items-center text-sm spcae-x-2">
                                <x-icon name="logout" class="w-5 h-5 mr-2"/>
                                <h1>Payment Out</h1>
                            </div>
                        </x-tab.title>
                    </div>
                </div>

                <!-- payment in -->
                <div x-show="tab == 0">
                    <x-card title="">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <x-select
                                label="Type of Payment In"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live="type_payment_in"
                            >
                                @foreach($option_payment_in as $item)
                                    <x-select.option label="{{ $item->value }}" value="{{  $item->value }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_payment_in == 'Payment Contribution')
                            <livewire:general.teller.common-page
                                module='paymentContribution'
                                searchMbrNo=true
                                searchTotContribution=true
                            />
                        @elseif($type_payment_in == 'Purchase Share')
                            <livewire:general.teller.common-page
                                module='purchaseShare'
                                searchMbrNo=true
                                searchTotShare=true
                            />
                        @elseif($type_payment_in == 'Financing Repayment')
                            <livewire:general.teller.common-page
                                module='financingRepayment'
                                searchMthInstallAmt=true
                                searchInstallAmtArear=true
                                searchTotContribution=true
                            />
                        @elseif($type_payment_in == 'Early Settlement Payment')
                            <livewire:general.teller.common-page
                                module='earlySettlementPayment'
                                searchAccNo=true
                                searchBalOutstanding=true
                                searchRebate=true
                                searchSettleProfit=true
                            />

                        @elseif($type_payment_in == 'Third Party')
                            <livewire:teller.third-party.third-party />

                        @elseif($type_payment_in == 'Miscellaneous in')
                            <livewire:general.teller.common-page
                                module='miscellaneousIn'
                                searchMbrNo=true
                                searchStaffNo=true
                            />

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
                            <x-select
                                label="Type of Payment Out"
                                placeholder="-- PLEASE SELECT --"
                                minItemsForSearch="1"
                                wire:model.live="type_payment_out"
                            >
                                @foreach($option_payment_out as $item)
                                    <x-select.option label="{{ $item->value }}" value="{{  $item->value }}" />
                                @endforeach
                            </x-select>
                        </div>
                    </x-card>

                    <div class="mt-5">
                        @if($type_payment_out == 'Withdraw Contribution')
                            <livewire:teller.withdraw-contribution.withdraw-contribution />

                        @elseif($type_payment_out == 'Withdraw Share')
                            <livewire:general.teller.common-page
                                module='withdrawShare'
                                searchMbrNo=true
                                searchTotShare=true
                            />
                        @elseif($type_payment_out == 'Close Membership')
                            <livewire:teller.close-membership.close-membership />

                        @elseif($type_payment_out == 'Payment to Members')
                            <livewire:teller.payment-member.payment-member />

                        @elseif($type_payment_out == 'Dividend Withdrawal')
                            <livewire:teller.withdraw-dividen.withdraw-dividen />

                        @elseif($type_payment_out == 'Disbursement')
                            <livewire:teller.disbursement.disbursement-transaction />

                        @elseif($type_payment_out == 'Miscellaneous Out')
                            <livewire:teller.miscellaneous-out.miscellaneous-out-list />

                        @elseif($type_payment_out == 'Refund Advance')
                            <livewire:teller.refund-advance.refund-advance-list />

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
