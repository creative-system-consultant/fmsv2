<div>
    <x-container title="Member Report" routeBackBtn="{{route('report.report-list')}}" titleBackBtn="report list" disableBackBtn="true">
        <div class="grid grid-cols-1 relative">
            <x-card title="List of Member Report">
                <div class="flex items-center space-x-2 mb-4 w-full">
                    <x-datetime-picker
                        label="Start Date"
                        wire:model.live="startDate"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />
                    <x-datetime-picker
                        label="End Date"
                        wire:model.live="endDate"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />
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
    </x-container>
</div>
