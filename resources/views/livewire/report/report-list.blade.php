
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
                                List Of Report
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
                                    <div class="py-2">
                                        <li>
                                            <p class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white pb-2">
                                                <span>MANAGEMENT</span>
                                            </p>
                                        </li>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Monthly Arreas</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="{{route('report.report-ma-age')}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Arrears Account By Age</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{route('report.report-ma-employer')}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Arrears Account By Employer</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{route('report.report-ma-state')}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Arrears Account By State</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{route('report.report-ma-product')}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Arrears Account By Product</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{route('report.report-ma-ageing')}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Arrears Ageing</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Monthly Contribution</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Contribution Summary</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Monthly Financing Position</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Financing Position Summary</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Monthly Npf</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Npf Summary</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Monthly Share</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Share Summary</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="border-t py-2 border-primary-50 dark:border-gray-700">
                                        <li>
                                            <p class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white pb-2">
                                                <span>OPERATION</span>
                                            </p>
                                        </li>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Contribution</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="collection" class="w-4 h-4 mr-2"/>
                                                        <span>Contribution Payment</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Contribution Wihdrawal</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Daily Transaction</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Daily Transaction Listing</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Daily Transaction By Product</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

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

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Financing Summary</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Financing Disbursement</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Financing Cash Detail</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Financing Approval</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>List</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Autopay</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{route('report.report-list-member')}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Member</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Closed Member</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of BSKE Account</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Bank</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Member Not Pay Contribution</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Dormant Member</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Entrance Fee</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Financing</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Full Settlement</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Introducer</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Deduction </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Retirement </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Non-Cash Products </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Detail Cash Disbursement </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>LIst Of Takaful Payment </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Dividend Payment </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Fin Transaction Base On Disbursement </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of BSKE & GOLDBAR Transactions </span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Member</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Member By Income</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Member By State</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Monthly</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Npf Account</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Arrears Account</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Monthly Financing Position</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>List Of Share Details </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Share Summary Yearly </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Financing Summary Yearly </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Details Yearly Share </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Details Yearly Contributions </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Details Financing Monthly </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Details Financing Yearly </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Month Arrears Report(Rescheduled) - Monthly </span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Share</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Share Purchase</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Share Redemption</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Share Withdrawal</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>Summary</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Summary Total Share</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Summary Total Contribution</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

                                        <div x-data={show:false}>
                                            <li x-on:click.prevent="show=!show" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
                                                <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white"> 
                                                    <x-icon name="collection" class="w-4 h-4 mr-2"/>   
                                                    <span>GL</span>
                                                </p>
                                                <div class="px-4" x-show="!show"  x-cloak>
                                                    <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                                <div class="px-4" x-show="show" x-cloak>
                                                    <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>   
                                                </div>
                                            </li>

                                            <div x-show="show" class="px-4 bg-gray-100 dark:bg-gray-800 ">
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Detail</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Detail GL by Account</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="#" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Detail GL By Bank Recon</span>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>

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

