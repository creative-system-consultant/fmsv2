
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

