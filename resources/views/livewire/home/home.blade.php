<div>
    {{-- modal to select client --}}
    <x-modal.card title="Select Client Account" align="center" blur wire:model.defer="selectClientModal" max-width="lg" hide-close="true">
        <div class="gap-4 my-2">
            <x-select
                label="Clients"
                placeholder="-- PLEASE SELECT --"
                wire:model="client"
            >

                @foreach ($clients as $client)
                    <x-select.option label="{{ strtoupper($client->name) }}" value="{{ $client->id }}" />
                @endforeach
            </x-select>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <div class="flex">
                    <x-button primary label="Save" wire:click="saveClient" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
    {{-- end modal select client --}}

    <div class="container mx-auto mt-4" x-data="{tab:0}">
        <div class="grid grid-cols-1 px-4 mb-20 sm:px-6 xl:mb-0">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 xl:col-span-8 2xl:col-span-8">
                    <div class="flex flex-col items-center justify-center px-6 py-8 border rounded-lg shadow-lg bg-white/70 backdrop-blur-lg md:px-12 2xl:px-24 sm:py-4 sm:h-72 dark:bg-gray-900/50 dark:border-black">
                        <div class="grid items-center justify-center grid-cols-1 md:grid-cols-2 dark:text-white">
                            <div class="flex flex-col order-last space-y-2 sm:order-first">
                                <h1 class="text-3xl font-bold text-center sm:text-left">
                                    Welcome to <span class="text-primary-500">FMS</span> Web
                                </h1>
                                <h4 class="text-sm leading-6 text-center text-gray-500 dark:text-white sm:text-left">
                                    Your dedicated management system for '{{ auth()->user()->refClient->name ?? auth()->user()->name }}.'
                                    This sophisticated platform is designed to streamline the organization and retrieval of information pertaining to
                                    '{{ auth()->user()->refClient->name ?? auth()->user()->name }},' ensuring that staff can efficiently access and manage their
                                    @if(auth()->user()->refClient->clientType->description ?? ''  == 'COOP')
                                        Cooperative's
                                    @elseif(auth()->user()->refClient->clientType->description ?? '' == 'CLUB')
                                        Club's
                                    @elseif(auth()->user()->refClient->clientType->description ?? '' == 'BANK')
                                        Bank
                                    @elseif(auth()->user()->refClient->clientType->description ?? '' == 'ARRAHNU')
                                        Arrahnu
                                    @elseif(auth()->user()->refClient->clientType->description ?? '' == 'JMB')
                                        Joint Management Body
                                    @elseif(auth()->user()->refClient->clientType->description ?? '' == 'ASSOCIATION')
                                        Association's
                                    @else
                                        {{auth()->user()->name}}
                                    @endif
                                    data.
                                </h4>
                            </div>
                            <div class="flex items-center justify-center ml-0 sm:-ml-2">
                                <img src="{{asset('herodashboard.png')}}" class="w-auto h-64 sm:h-64" alt="Hero"/>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex flex-col px-4 py-6 mt-6 mb-20 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-black" >
                            <div>
                                <div class="flex mb-4 overflow-x-auto overflow-y-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
                                        <div class="flex items-center flex-shrink-0 space-x-4 ">
                                            <x-tab.title name="0">
                                                <div class="flex items-center space-x-2 text-sm" >
                                                    <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                                    <h1>Contribution Request</h1>
                                                </div>
                                            </x-tab.title>
                                            <x-tab.title name="1">
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <x-icon name="clipboard-list" class="w-5 h-5 mr-2" />
                                                    <h1>Share Request</h1>
                                                </div>
                                            </x-tab.title>
                                            <x-tab.title name="2">
                                                <div class="flex items-center space-x-2 text-sm" >
                                                    <x-icon name="clipboard-list" class="w-5 h-5 mr-2"/>
                                                    <h1>Dividend Request</h1>
                                                </div>
                                            </x-tab.title>
                                        </div>
                                </div>
                                <div x-show="tab == 0">
                                    <div class="mt-2">
                                            <x-table.table>
                                                <x-slot name="thead">
                                                    <x-table.table-header class="text-left" value="NO" sort="" />
                                                    <x-table.table-header class="text-left" value="NAME" sort="" />
                                                    <x-table.table-header class="text-left" value="TOTAL CONTRIBUTION" sort="" />
                                                    <x-table.table-header class="text-left" value="AMOUNT APPLIED" sort="" />
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @forelse($contribution_req as $item)
                                                    <tr>
                                                        <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                            {{ $loop->iteration }}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700">
                                                            <a href="{{route('teller.teller-list')}}">{{ $item->name }}</a>
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700" href="{{route('profile')}}">
                                                            <a href="{{ route('teller.teller-list') }}">{{$item->total_contribution}}</>
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700" href="{{route('profile')}}">
                                                            <a href="{{ route('teller.teller-list') }}">{{ number_format($item->approved_amt,2,'.',',') }}</>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                            <x-no-data title="No data"/>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @endforelse
                                                </x-slot>
                                            </x-table.table>
                                            {{-- <div class="mt-4">
                                                {{ $disb->links('livewire::pagination-links') }}
                                            </div> --}}
                                    </div>
                                    {{-- bar chart contribution --}}
                                    <div class="flex flex-col px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:text-white dark:border-black">
                                        <div class="p-4 bg-white border-[1.5px dark:border-gray-800">
                                            <b class="inline-flex space-y-1 text-sm">Total Application Contribution</b>
                                            <div id="barChartCont" wire:ignore></div>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="tab == 1">
                                    <div class="mt-2">
                                        <x-table.table>
                                            <x-slot name="thead">
                                                <x-table.table-header class="text-left" value="NO" sort="" />
                                                <x-table.table-header class="text-left" value="NAME" sort="" />
                                                <x-table.table-header class="text-left" value="TOTAL SHARE" sort="" />
                                                <x-table.table-header class="text-left" value="SHARE APPLIED" sort="" />
                                            </x-slot>
                                            <x-slot name="tbody">
                                                @forelse($share_req as $item)
                                                <tr>
                                                    <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                        {{ $loop->iteration }}
                                                    </x-table.table-body>

                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        {{$item->name}}
                                                    </x-table.table-body>

                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        {{ number_format($item->total_share,2,'.',',') }}
                                                    </x-table.table-body>

                                                    <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                        {{ number_format($item->approved_amt,2,'.',',') }}
                                                    </x-table.table-body>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                        <x-no-data title="No data"/>
                                                    </x-table.table-body>
                                                </tr>
                                                @endforelse
                                            </x-slot>
                                        </x-table.table>
                                        {{-- <div class="mt-4">
                                            {{ $disb->links('livewire::pagination-links') }}
                                        </div> --}}
                                    </div>
                                    {{-- bar chart share --}}
                                    <div class="flex flex-col px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:text-white dark:border-black">
                                        <div class="p-4 bg-white border-[1.5px dark:border-gray-800">
                                            <b class="inline-flex space-y-1 text-sm">Total Application Share</b>
                                            <div id="barChartShare" wire:ignore></div>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="tab == 2">
                                    <div class="mt-2">
                                            <x-table.table>
                                                <x-slot name="thead">
                                                    <x-table.table-header class="text-left" value="NO" sort="" />
                                                    <x-table.table-header class="text-left" value="NAME" sort="" />
                                                    <x-table.table-header class="text-left" value="DIVIDEND TOTAL" sort="" />
                                                    <x-table.table-header class="text-left" value="DIVIDEND APPLIED" sort="" />
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @forelse($dividen_req as $item)
                                                    <tr>
                                                        <x-table.table-body colspan="" class="py-3 text-xs font-medium text-gray-700">
                                                            {{ $loop->iteration }}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->name}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{$item->dividend_total}}
                                                        </x-table.table-body>

                                                        <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 ">
                                                            {{ number_format($item->div_cash_approved,2,'.',',') }}
                                                        </x-table.table-body>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <x-table.table-body colspan="" class="text-xs font-medium text-center text-gray-700 ">
                                                            <x-no-data title="No data"/>
                                                        </x-table.table-body>
                                                    </tr>
                                                    @endforelse
                                                </x-slot>
                                            </x-table.table>
                                            {{-- <div class="mt-4">
                                                {{ $disb->links('livewire::pagination-links') }}
                                            </div> --}}
                                    </div>
                                    {{-- bar chart div --}}
                                    <div class="flex flex-col px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:text-white dark:border-black">
                                        <div class="p-4 bg-white border-[1.5px dark:border-gray-800">
                                            <b class="inline-flex space-y-1 text-sm">Total Application Dividen</b>
                                            <div id="barChartDiv" wire:ignore></div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                </div>


                <div class="col-span-12 sm:col-span-12 md:col-span-12 xl:col-span-4 2xl:col-span-4">
                    <div class="hidden xl:block">
                        <div class="flex flex-col items-center justify-center p-4 px-12 border rounded-lg shadow-lg bg-white/70 dark:bg-gray-900/50 dark:border-black dark:text-white backdrop-blur-lg h-72">
                            <x-avatar class="border-2 border-primary-700" size="w-32 h-32" src="{{ (auth()->user()->profile_photo_path) ? asset('storage/'.auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}" />
                            <h1 class="pt-2">
                                {{ auth()->user()->name }}
                            </h1>
                            <h1 class="pt-1 text-sm text-gray-500 dark:text-white">
                                {{ auth()->user()->email }}
                            </h1>
                            <div class="w-1/2 mt-5">
                                <x-button class="w-full py-3" href="{{route('profile')}}" rounded primary label="Edit Profile" />
                            </div>
                        </div>
                    </div>
                
                            <div class="flex flex-col justify-center px-4 py-6 mt-6 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:text-white dark:border-black">
                                <div class="p-4 bg-white border-[1.5px dark:border-gray-800">
                                    <b class="text-sm pb-3 ">Total Withdrawal Request Pending Processing {{ $currentDate }}</b>
                                        <div class ="my-7 " id="pieChart" wire:ignore></div>
                                        <div class="w-1/2 mt-5 mx-28   ">
                                            <x-button class="w-full py-3" href="{{route('teller.teller-list')}}" rounded primary label=" Go to Teller" />
                                        </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- script dashboard chart  --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@push('js')

{{-- barchart_contribution --}}
    <script>
        
        let darkMode = localStorage.getItem('theme') === 'dark';
        let dataLabelColor = darkMode ? 'white' : 'black';
    
        let barChartData = @json($barchartcont);
        // console.log('barChart');
        // console.log(barChartData);
        data2 = JSON.parse(barChartData);
    
        data3 = []
        name3 = []
    
        function getRandomColor() {
        let letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
            return color;
        }
    
        let colors = [];
        for(i=0;i<data2.length;i++){
            data3.push(data2[i]['total_rows'])
            name3.push(data2[i]['contribution_date'])
        }
    
        for(i=0;i<name3.length;i++){
            colors.push(getRandomColor());
        }

        var options = {
            series: [{
                name: 'RESULT',
                data: data3
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
            },
            colors: colors,
            responsive: [{
                breakpoint: 500,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal:false,
                    borderRadius: 1,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900,
                                color:dataLabelColor
                            }
                        }
                    }
                },
            },
            xaxis: {
                labels: {
                    show:false,
                },
                categories: name3,
            },
            yaxis: {
            title: {
                text: 'Total Application'
            }
            },
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            },
            fill: {
                opacity: 1
            }
        };
        var chart = new ApexCharts(document.getElementById("barChartCont"), options);
        chart.render();
    </script>

{{-- barchart_share --}}
    <script>
        let darkMode2 = localStorage.getItem('theme') === 'dark';
        let dataLabelColor2 = darkMode ? 'white' : 'black';

        let barChartData_share = @json($barchartshare);
        // console.log('barChart');
        // console.log(barChartData);
        data2 = JSON.parse(barChartData_share);

        data3 = []
        name3 = []

        function getRandomColor() {
        let letters2 = '0123456789ABCDEF';
        let color2 = '#';
        for (let b = 0; b < 6; b++) {
            color2 += letters2[Math.floor(Math.random() * 16)];
        }
            return color2;
        }

        let colors2 = [];
        for(b=0;b<data2.length;b++){
            data3.push(data2[b]['total_rows'])
            name3.push(data2[b]['share_date'])
        }

        for(b=0;b<name3.length;b++){
            colors2.push(getRandomColor());
        }

        var options = {
            series: [{
                name: 'RESULT',
                data: data3
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
            },
            colors: colors,
            responsive: [{
                breakpoint: 500,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal:false,
                    borderRadius: 1,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900,
                                color:dataLabelColor
                            }
                        }
                    }
                },
            },
            xaxis: {
                labels: {
                    show:false,
                },
                categories: name3,
            },
            yaxis: {
            title: {
                text: 'Total Application'
            }
            },
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            },
            fill: {
                opacity: 1
            }
        };
        var chart = new ApexCharts(document.getElementById("barChartShare"), options);
        chart.render();
    </script>

{{-- barchart_div --}}
    <script>
        let darkMode3 = localStorage.getItem('theme') === 'dark';
        let dataLabelColor3 = darkMode ? 'white' : 'black';

        let barChartData_div = @json($barchartdiv);
        // console.log('barChart');
        // console.log(barChartData);
        data2 = JSON.parse(barChartData_div);

        data3 = []
        name3 = []

        function getRandomColor() {
        let letters3 = '0123456789ABCDEF';
        let color3 = '#';
        for (let c = 0; c < 6; c++) {
            color3 += letters3[Math.floor(Math.random() * 16)];
        }
            return color3;
        }

        let colors3 = [];
        for(c=0;c<data2.length;c++){
            data3.push(data2[c]['total_rows'])
            name3.push(data2[c]['div_date'])
        }

        for(c=0;c<name3.length;c++){
            colors3.push(getRandomColor());
        }

        var options = {
            series: [{
                name: 'RESULT',
                data: data3
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
            },
            colors: colors,
            responsive: [{
                breakpoint: 500,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal:false,
                    borderRadius: 1,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900,
                                color:dataLabelColor
                            }
                        }
                    }
                },
            },
            xaxis: {
                labels: {
                    show:false,
                },
                categories: name3,
            },
            yaxis: {
            title: {
                text: 'Total Application'
            }
            },
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            },
            fill: {
                opacity: 1
            }
        };
        var chart = new ApexCharts(document.getElementById("barChartDiv"), options);
        chart.render();
    </script>

{{-- chartPie --}}
    <script>
            var options = {
                series: [ {{$withdrawContributionCount}}, {{ $withdrawShareCount }}, {{ $dividendWithdrawalCount }}],
                chart: {
                    type: 'pie',
                    height: 350,
                },
                colors: [],
                dataLabels: {
                    style: {
                        fontSize: "20px",
                        fontWeight: "bold",
                    },
                },
                tooltip: {
                    style: {
                        fontSize: '15px',
                        colors: '#000000',
                    }
                },
                // title: {
                //     text: 'Total Withdrawal Request Pending Processing No of Request',
                //     align: 'center'
                // },
                labels: ['Contribution', 'Share', 'Dividen' ],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                        },
                    }
                }]
            };
            var chart = new ApexCharts(document.getElementById('pieChart'), options);
            chart.render();
    </script>

@endpush

