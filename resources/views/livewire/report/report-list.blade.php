
<div class="relative" x-data="searching()">
    <div class="fixed top-0 bottom-0 left-0 right-0 z-50  mt-12 overflow-hidden lg:mt-0  max-w-lg"
        :class="{
            'lg:left-[16rem] left-0': !toggleSidebarDesktop,
            'lg:left-[5rem] left-0': toggleMiniSidebar,
            'lg:left-0': toggleSidebarDesktop,
        }"
        x-cloak>
        <section class="absolute inset-y-0 left-0 flex max-w-full z-50 " aria-labelledby="slide-over-heading">
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
                                x-model="searchTerm"
                                x-on:input="shouldShowDropdown()"
                            />
                        </div>
                        <div class="py-3 border-2 rounded border-primary-50 dark:border-gray-800 ">
                            <div class="h-full leading-6" aria-hidden="true">
                                <ul id="myUL" class="list-none">
                                    <div class="py-2">
                                        <li>
                                            <p class="inline-flex items-center w-full px-4 py-2 pb-2 text-sm font-semibold text-gray-500 dark:text-white">
                                                <span>MANAGEMENT</span>
                                            </p>
                                        </li>

                                        <x-general.dropdown-item icon="collection" title="Monthly Arreas" index="1">
                                            <x-general.nav-item
                                                title="Monthly Arrears Account By Age"
                                                href="{{route('report.management.report-ma-age')}}"
                                            />
                                            <x-general.nav-item
                                                title="Monthly Arrears Account By Employer"
                                                href="{{route('report.management.report-ma-employer')}}"
                                            />
                                            <x-general.nav-item
                                                title="Monthly Arrears Account By State"
                                                href="{{route('report.management.report-ma-state')}}"
                                            />
                                            <x-general.nav-item
                                                title="Monthly Arrears Account By Product"
                                                href="{{route('report.management.report-ma-product')}}"
                                            />
                                            <x-general.nav-item
                                                title="Monthly Arrears Ageing"
                                                href="{{route('report.management.report-ma-ageing')}}"
                                            />
                                        </x-general.nav-item>

                                        <x-general.dropdown-item icon="collection" title="Monthly Contribution" index="2">
                                            <x-general.nav-item
                                                title="Monthly Contribution Summary"
                                                href="{{route('report.management.report-mc-summary')}}"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Monthly Financing Position" index="3">
                                            <x-general.nav-item
                                                title="Monthly Financing Position Summary"
                                                href="{{route('report.management.report-mfp-summary')}}"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Monthly Npf" index="4">
                                            <x-general.nav-item
                                                title="Monthly Npf Summary"
                                                href="{{route('report.management.report-mnpf-summary')}}"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Monthly Share" index="5">
                                            <x-general.nav-item
                                                title="Monthly Share Summary"
                                                href="{{route('report.management.report-ms-summary')}}"
                                            />
                                        </x-general.dropdown-item>

                                    </div>
                                    <div class="py-2 border-t border-primary-50 dark:border-gray-700">
                                        <li>
                                            <p class="inline-flex items-center w-full px-4 py-2 pb-2 text-sm font-semibold text-gray-500 dark:text-white">
                                                <span>OPERATION</span>
                                            </p>
                                        </li>

                                        <x-general.dropdown-item icon="collection" title="Contribution" index="6">
                                            <x-general.nav-item
                                                title="Contribution Payment"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Contribution Wihdrawal"
                                                href="#"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Daily Transaction" index="7">
                                            <x-general.nav-item
                                                title="Daily Transaction Listing"
                                                href="{{ route('report.operation.dailytransaction.listing') }}"
                                            />
                                            <x-general.nav-item
                                                title="Daily Transaction By Product"
                                                href="{{ route('report.operation.dailytransaction.product') }}"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Financing" index="8">
                                            <x-general.nav-item
                                                title="Financing Summary"
                                                href="{{ route('report.operation.financing.summary') }}"
                                            />
                                            <x-general.nav-item
                                                title="Financing Disbursement"
                                                href="{{ route('report.operation.financing.disbursement') }}"
                                            />
                                            <x-general.nav-item
                                                title="Financing Cash Detail"
                                                href="{{ route('report.operation.financing.cashdetail') }}"
                                            />
                                            <x-general.nav-item
                                                title="Financing Approval"
                                                href="#"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="List" index="9">
                                            <x-general.nav-item
                                                title="List Of Autopay"
                                                href="{{ route('report.operation.list.autopay') }}"
                                            />
                                            <x-general.nav-item
                                                title="List Of Member"
                                                href="{{route('report.operation.list.member')}}"
                                            />
                                            <x-general.nav-item
                                                title="List Of Closed Member"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of BSKE Account"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Bank"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Member Not Pay Contribution"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Dormant Member"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Entrance Fee"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Financing"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Full Settlement"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Introducer"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Deduction"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Retirement"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Non-Cash Products"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Detail Cash Disbursement"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Takaful Payment"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Dividend Payment"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Fin Transaction Base On Disbursement"
                                                href="{{ route('report.operation.list.fin-trx-base-disbursement') }}"
                                            />
                                            <x-general.nav-item
                                                title="List Of BSKE & GOLDBAR Transactions"
                                                href="#"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Member" index="10">
                                            <x-general.nav-item
                                                title="Member By Income"
                                                href="{{ route('report.operation.member.byincome') }}"
                                            />
                                            <x-general.nav-item
                                                title="Member By State"
                                                href="#"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Monthly" index="11">
                                            <x-general.nav-item
                                                title="Monthly Npf Account"
                                                href="{{ route('report.operation.monthly.mthlynpfacc') }}"
                                            />
                                            <x-general.nav-item
                                                title="Monthly Arrears Account"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Monthly Financing Position"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="List Of Share Details"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Share Summary Yearly"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Financing Summary Yearly"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Details Yearly Share"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Details Yearly Contributions"
                                                href="#"
                                            />
                                            <x-general.nav-item
                                                title="Details Financing Monthly"
                                                href="#"
                                            />  
                                            <x-general.nav-item
                                                title="Details Financing Yearly"
                                                href="#"
                                            /> 
                                            <x-general.nav-item
                                                title="Month Arrears Report(Rescheduled) - Monthly"
                                                href="#"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Share" index="12">
                                            <x-general.nav-item
                                                title="Share Purchase"
                                                href="{{ route('report.operation.share.share-purchase') }}"
                                            />
                                            <x-general.nav-item
                                                title="Share Redemption"
                                                href="{{ route('report.operation.share.share-redemption') }}"
                                            />
                                            <x-general.nav-item
                                                title="Share Withdrawal"
                                                href="{{ route('report.operation.share.share-withdrawal') }}"
                                            />
                                        </x-general.dropdown-item>

                                        <x-general.dropdown-item icon="collection" title="Summary" index="13">
                                            <x-general.nav-item
                                                title="Summary Total Share"
                                                href="{{ route('report.operation.summary.sum-total-share') }}"
                                            />
                                            <x-general.nav-item
                                                title="Summary Total Contribution"
                                                href="{{ route('report.operation.summary.sum-total-cont') }}"
                                            />
                                        </x-general.dropdown-item>

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
                                                    <a wire:navigate href="{{ route('report.operation.member.byincome') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
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
                                                    <a wire:navigate href="{{ route('report.operation.monthly.mthlynpfacc') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
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
                                                    <a wire:navigate href="{{ route('report.operation.share.share-purchase') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Share Purchase</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{ route('report.operation.share.share-redemption') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Share Redemption</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{ route('report.operation.share.share-withdrawal') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
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
                                                    <a wire:navigate href="{{ route('report.operation.summary.sum-total-share') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
                                                        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
                                                        <span>Summary Total Share</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a wire:navigate href="{{ route('report.operation.summary.sum-total-cont') }}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
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
        function searching() {
            return {
                searchTerm: '',
                showDropdowns: Array(10).fill(false),
                toggleDropdown(index) {
                    if (this.showDropdowns[index]) {
                        this.showDropdowns[index] = false;
                    } else {
                        this.showDropdowns = this.showDropdowns.map(() => false);
                        this.showDropdowns[index] = true;
                    }
                },
                shouldShowDropdown(index) {
                    if (this.searchTerm) {
                        const searchTermLower = this.searchTerm.toLowerCase();
                        const listItems = this.$el.querySelectorAll('.search-item');
                        return [...listItems].some(item => item.textContent.toLowerCase().includes(searchTermLower));
                    }
                    return this.showDropdowns[index];
                },
                itemMatches(el) {
                    if (!this.searchTerm) return true;
                    const searchTermLower = this.searchTerm.toLowerCase();
                    const itemText = el.querySelector('.search-item').textContent.toLowerCase();
                    return itemText.includes(searchTermLower);
                }
            };
        }
    </script>
@endpush

