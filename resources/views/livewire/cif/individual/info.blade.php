<style>
    ul.flex {
        list-style-type: none; /* Remove bullet points */
        padding: 0;
    }

    ul.flex li {
        margin-right: 1rem;
    }
</style>

<div>
    <x-container title="Member Information" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div>
            <div style="margin-bottom: 50px;">
                <x-card title="Category">
                    <ul class="flex border-b">
                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('details')">
                                <x-icon name="user-circle" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('address')">
                                <x-icon name="home" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('beneficiary')">
                                <x-icon name="user-group" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('contribution')">
                                <x-icon name="cash" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('share')">
                                <x-icon name="presentation-chart-line" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('finance')">
                                <x-icon name="currency-dollar" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue-dark font-semibold" href="javascript:void(0)" onclick="showTab('third-party')">
                                <x-icon name="information-circle" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('guarantee')">
                                <x-icon name="shield-check" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('others-payment')">
                                <x-icon name="credit-card" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('monthly-payment')">
                                <x-icon name="calendar" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('dividend-statements')">
                                <x-icon name="clipboard-list" class="w-6 h-6"/>
                            </a>
                        </li>

                        <li>
                            <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" href="javascript:void(0)" onclick="showTab('Miscellaneous')">
                                <x-icon name="inbox" class="w-6 h-6"/>
                            </a>
                        </li>

                    </ul>
                </x-card>
            </div>

            <div style="margin-bottom: 50px;">
                <div id="tab-details" >
                    @include('livewire.cif.info.details')
                </div>

                <div id="tab-address" >
                    @include('livewire.cif.info.address')
                </div>

                <div id="tab-beneficiary">
                    @include('livewire.cif.info.beneficiary')
                </div>

                <div id="tab-contribution" >
                    {{-- @include('file path blade') --}}
                </div>

                <div id="tab-share" >
                    {{-- @include('file path blade') --}}
                </div>

                <div id="tab-finance">
                    {{-- @include('file path blade') --}}
                </div>

                <div id="tab-third-party" >
                    @include('livewire.cif.info.third-party-info')
                </div>

                <div id="tab-guarantee" >
                    @include('livewire.cif.info.guarantee')
                </div>

                <div id="tab-others-payment">
                    @include('livewire.cif.info.others-payment')
                </div>

                <div id="tab-monthly-payment" >
                   {{-- @include('file path blade') --}}
                </div>

                <div id="tab-dividend-statements" >
                    {{-- @include('file path blade') --}}
                </div>

                <div id="tab-Miscellaneous">
                    {{-- @include('file path blade') --}}
                </div>
            </div>
        </div>
    </x-container>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Show the first tab content
    var defaultTab = 'details';
    showTab(defaultTab);
    });

    function showTab(tabId) {
        var tabs = ['details','address','beneficiary','contribution','share','finance','third-party', 'guarantee', 'others-payment','monthly-payment','dividend-statements','Miscellaneous'];
        for (var i = 0; i < tabs.length; i++) {
            var content = document.getElementById('tab-' + tabs[i]);
            if (tabs[i] === tabId) {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        }
    }
</script>

