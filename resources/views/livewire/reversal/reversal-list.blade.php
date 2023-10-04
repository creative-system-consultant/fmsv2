
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
                                List Of Reversal
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
                                        <p class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white">
                                            <span>REVERSAL</span>
                                        </p>
                                    </li>
                                    <div x-data={show:false}>
                                        <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                            <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                <span>Financing</span>
                                            </p>
                                            <div class="px-4" x-show="!show"  x-cloak>
                                                <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                            </div>
                                            <div class="px-4" x-show="show" x-cloak>
                                                <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                            </div>
                                        </li>

                                        <div x-show="show" class="px-4 bg-gray-50 dark:bg-gray-800 ">
                                            <li>
                                                <a wire:navigate href="{{ route('reversal.reversal-disbursement') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                    <span>Disbursement</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a wire:navigate href="{{ route('reversal.reversal-financing-repayment') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                    <span>Financing Repayment</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a wire:navigate href="{{ route('reversal.reversal-early-settlement') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                    <span>Early Settlement</span>
                                                </a>
                                            </li>
                                        </div>
                                    </div>

                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-share') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Share</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-contribution') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Contribution</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-other-payment') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Other Payment</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-miscellaneous') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Miscellaneous</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-third-party') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Third Party</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-dividend') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Dividend</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a wire:navigate href="{{ route('reversal.reversal-refund-advance') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                            <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                            <span>Refund Advance</span>
                                        </a>
                                    </li>
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

