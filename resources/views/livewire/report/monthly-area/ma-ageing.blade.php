<div>
    <x-container title="Monthly Arreas" routeBackBtn="{{route('report.report-list')}}" titleBackBtn="report list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <x-card title="Monthly Arreas By Ageing Report">
                <div class="flex items-center space-x-2 mb-4">
                    <x-input 
                        label="Start Date" 
                        wire:model="startDate"
                        type="date"
                    />
                    <x-input 
                        label="End Date" 
                        wire:model="endDate"
                        type="date"
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
