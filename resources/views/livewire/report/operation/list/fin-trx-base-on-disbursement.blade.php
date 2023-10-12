<div>
    <x-container title="Monthly Share" routeBackBtn="{{ route('report.report-list') }}" titleBackBtn="report list" disableBackBtn="true">
        <div class="grid grid-cols-1">
            <x-card title="List Of Fin Transaction Base On Disbursement ">
                <div class="flex items-center mb-4 space-x-2">
                    <x-datetime-picker
                        label="Start Date"
                        wire:model="startDate"
                        without-time=true
                        display-format="DD/MM/YYYY"
                    />
                    <x-datetime-picker
                        label="End Date"
                        wire:model="endDate"
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