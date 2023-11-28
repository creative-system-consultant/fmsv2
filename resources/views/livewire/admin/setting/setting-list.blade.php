
<div class="relative" x-data="searching()">
    <div class="fixed top-0 bottom-0 left-0 right-0 z-50 max-w-lg mt-12 overflow-hidden lg:mt-0"
        :class="{
            'lg:left-[16rem] left-0': !toggleSidebarDesktop,
            'lg:left-[5rem] left-0': toggleMiniSidebar,
            'lg:left-0': toggleSidebarDesktop,
        }"
        x-cloak>
        <section class="absolute inset-y-0 left-0 z-50 flex max-w-full" aria-labelledby="slide-over-heading">
            <div class="relative w-screen max-w-md">

                <div class="flex flex-col h-full py-6 pt-0 overflow-auto bg-white shadow-xl animate__animated animate__fadeInLeft dark:bg-gray-900">
                    <div class="relative flex-shrink-0 overflow-hidden bg-primary-600 ">
                        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                            <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                            <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                        </svg>
                        <div class="relative flex items-center p-4">
                            <h2 class="text-base font-semibold text-white uppercase">
                                List Of Setting
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
                                        @foreach($settingMaintenance as $groupTitle => $items )
                                        @php
                                            $groupHasPermittedItems = false;
                                            foreach ($items as $item) {
                                                if (auth()->check() && auth()->user()->hasClientSpecificPermission($item['permission'], auth()->user()->client_id)) {
                                                    $groupHasPermittedItems = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if($groupHasPermittedItems)
                                            <x-general.dropdown-item icon="collection" title="{{ $groupTitle }}" index="{{ $items->first()['index']}}">
                                                @foreach ($items as $item)
                                                    @if (auth()->check() && auth()->user()->hasClientSpecificPermission($item['permission'], auth()->user()->client_id))
                                                        <x-general.nav-item
                                                            title="{{ $item['title'] }}"
                                                            href="{{ route($item['route']) }}"
                                                        />
                                                    @endif
                                                @endforeach
                                            </x-general.dropdown-item>
                                        @endif
                                    @endforeach
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
