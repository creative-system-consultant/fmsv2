
<div>
    <div wire:loading wire:target="setState">
        @include('misc.loading')
    </div>
    <x-container title="Member Information" routeBackBtn="{{ route('cif.main') }}" titleBackBtn="member info" disableBackBtn="true">
        <div x-data="{ active: @entangle('setIndex') }" class="relative">
            <div class=" bg-white border rounded-lg shadow-md w-full dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 ">
                <div class="flex items-center justify-between px-4 py-4 border-b dark:border-gray-700">
                    <h1 class="font-semibold text-lg dark:text-white">Category</h1>
                    <div class="bg-white border-2 border-black dark:border-gray-400 dark:text-white dark:bg-gray-800 px-4 py-2 text-xs rounded-lg text-black flex space-x-2 items-center">
                        <x-icon name="user-circle" class="w-5 h-5"/>
                        <p>{{ $name }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start sm:justify-start">
                    @foreach(config('module.member-info.cif.index') as $config)
                        @php
                            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                        @endphp
                        @if($hasPermission)
                            <x-hovertab.title name="{{ $config['index'] }}" wire:click="setState({{ $config['index'] }})">
                                <x-icon name="{{ $config['icon'] }}" class="w-6 h-6 mr-2"/>
                                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                    {{ $config['name'] }}
                                </span>
                            </x-hovertab.title>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="mt-12">
                @foreach(config('module.member-info.cif.index') as $config)
                    @php
                        $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
                    @endphp
                    @if($setIndex == $config['index'])
                        @if($hasPermission)
                            @switch($setIndex)
                                @case('0')
                                    <livewire:cif.info.details :uuid="$uuid" />
                                    @break
                                @case('1')
                                    <livewire:cif.info.address :uuid="$uuid" />
                                    @break
                                @case('2')
                                    <livewire:cif.info.beneficiary :uuid="$uuid" />
                                    @break
                                @case('3')
                                    <livewire:cif.info.contribution :uuid="$uuid" />
                                    @break
                                @case('4')
                                    <livewire:cif.info.share :uuid="$uuid" />
                                    @break
                                @case('5')
                                    <livewire:cif.info.others-payment :uuid="$uuid" />
                                    @break
                                @case('6')
                                    <livewire:cif.info.monthly-payment-summary :uuid="$uuid" />
                                    @break
                                @case('7')
                                    <livewire:cif.info.dividend-statement :uuid="$uuid" />
                                    @break
                                @case('8')
                                    <livewire:cif.info.miscellaneous :uuid="$uuid" />
                                    @break
                            @endswitch
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </x-container>
</div>


@push('js')
<script>
    function deleteAddress(key){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.deleteAddress(key)
            }
        })
    }
    window.addEventListener('swal',function(e){Swal.fire(e.detail);});
</script>

@if(session()->has('createCustomer'))
<script>
    Swal.fire({
            title               : 'Created!',
            text                : 'The member have been created!.',
            icon                : 'success',
            showConfirmButton   : false,
            timer               : 1500,
        })
</script>
@endif
@endpush
