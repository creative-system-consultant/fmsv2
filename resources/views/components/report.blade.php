<div>
    <x-container title="Monthly Share" routeBackBtn="{{ route('report.report-list') }}" titleBackBtn="report list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <x-card title="{{ $title }}">
                <div class="flex items-center mb-4 space-x-2">
                    @if($startDate)
                        <x-datetime-picker
                            label="Start Date"
                            wire:model="startDate"
                            without-time=true
                            display-format="DD/MM/YYYY"
                        />
                    @endif

                    @if($endDate)
                        <x-datetime-picker
                            label="End Date"
                            wire:model="endDate"
                            without-time=true
                            display-format="DD/MM/YYYY"
                        />
                    @endif

                    @if($reportDate)
                        <x-datetime-picker
                            label="Report Date"
                            wire:model="reportDate"
                            without-time=true
                            display-format="DD/MM/YYYY"
                        />
                    @endif

                    {{ $slot }}

                    <div class="mt-7">
                        <x-button
                            sm
                            icon="document-report"
                            green
                            label="Excel"
                            wire:click="generateExcel"
                        />
                    </div>
                </div>
            </x-card>
        </div>

        @if($result && $result->count() > 0)
            <?php $firstRow = $result->first(); ?>

            <div class="mt-4">
                <x-card>
                    @if($firstRow)
                        <x-table.table>
                            <x-slot name="thead">
                                @foreach($firstRow as $column => $cell)
                                    <x-table.table-header value="{{ $column }}" sort="" />
                                @endforeach
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach($result as $row)
                                    <tr>
                                        @foreach($row as $column => $cell)
                                            @php
                                                $alignment = $cell['align'] === 'right' ? 'text-right' : 'text-left';
                                            @endphp
                                            <x-table.table-body colspan="" class="text-xs font-medium text-gray-700 {{ $alignment }}">
                                                {{ $cell['value'] }}
                                            </x-table.table-body>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-table.table>

                        <div class="py-4">
                            {{ $result->links() }}
                        </div>
                    @endif
                </x-card>
            </div>
        @endif

    </x-container>
</div>