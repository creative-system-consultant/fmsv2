<div>
    <x-container title="Monthly Share" routeBackBtn="{{route('report.report-list')}}" titleBackBtn="report list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <x-card title="Monthly Share Summary Report">
                <div class="flex items-center space-x-2 mb-4">
                    <x-input 
                        label="Report Date" 
                        wire:model="reportDate"
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