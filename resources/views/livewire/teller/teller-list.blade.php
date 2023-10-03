
<div class="relative">
    <div class="fixed top-0 bottom-0 right-0 z-50 mt-12 overflow-hidden lg:mt-0"
        :class="{
            'lg:left-[16rem] left-0': !toggleSidebarDesktop,
            'lg:left-[5rem] left-0': toggleMiniSidebar,
            'lg:left-0': toggleSidebarDesktop,
        }"
        x-cloak>
        <section class="absolute inset-y-0 left-0 flex max-w-full " aria-labelledby="slide-over-heading">
            <div class="relative w-screen max-w-md">

                <div class="flex flex-col h-full py-6 pt-0 overflow-auto bg-white shadow-xl animate__animated animate__fadeInLeft dark:bg-gray-900">
                    <div class="relative flex-shrink-0 overflow-hidden bg-primary-600 ">
                        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                            <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                            <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                        </svg>
                        <div class="relative flex items-center p-4">
                            <h2 class="text-base font-semibold text-white uppercase">
                                List Of Teller
                            </h2>
                        </div>
                    </div>

                    <div class="relative flex-1 px-4 mt-6 sm:px-6">
                        <!-- Replace with your content -->
                        <div class="mb-4">
                            <x-input
                                placeholder="Search"
                                id="myInput"
                                onkeyup="myFunction()"
                            />
                        </div>
                        <div class="py-3 border-2 rounded border-primary-50 dark:border-gray-800 ">
                            <div class="h-full leading-6" aria-hidden="true">
                                <ul id="myUL" class="list-none">
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-refund-advance-list') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Refund Advance</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-miscellaneous-out-list') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Miscellaneous Out</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-disbursement') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Disbursement</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-payment-contribution') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Payment Contribution</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-purchase-share') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Purchase Share</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-miscellaneous-in') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Miscellaneous In</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-withdraw-contribution') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Withdraw Contribution</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-withdraw-share') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Withdraw Share</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-close-membership') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Close Membership</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-transfer-share') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Transfer Share</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-financing-repayment') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Financing Repayment</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-payment-member') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Payment To Member</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-early-settlement-payment') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Early Setllement Payment</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-third-party') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Third Party</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-virtual-account-inventory') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Virtual Account Inventory</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-withdraw-dividen') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Dividend Withdrawal</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('teller.teller-account-overlap') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Account Overlap</span>
                                        </a>
                                    </li>
                                    <div class="border-y dark:border-gray-700 border-primary-200 py-2">
                                        <li>
                                            <h1 class="text-sm font-semibold  px-4 py-2 dark:text-white">GENERAL PAYMENT</h1>
                                        </li>
                                        <li>
                                            <a wire:navigate href="{{ route('teller.teller-bulk-payment') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                <span>Bulk Payment</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a wire:navigate href="{{ route('teller.teller-autopay') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                <span>Autopay</span>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="border-y dark:border-gray-700 border-primary-200 py-2">
                                        <li>
                                            <h1 class="text-sm font-semibold  px-4 py-2 dark:text-white">GL</h1>
                                        </li>
                                        <li>
                                            <a wire:navigate href="{{ route('teller.teller-gl-transaction') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                <span>GL Transaction</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a wire:navigate href="{{ route('teller.teller-settlement-overlap') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                <span>Early Settlement Overlap</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a wire:navigate href="{{ route('teller.teller-dividen-approval') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                <span>Dividen Approval</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a wire:navigate href="{{ route('teller.teller-dividen-batch-withdraw') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                <span>Dividen Batch Widthdrawal</span>
                                            </a>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


@push('js')
<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
@endpush

