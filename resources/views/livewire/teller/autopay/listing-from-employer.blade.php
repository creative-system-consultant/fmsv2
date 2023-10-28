<div>
    <x-card title="Upload Autopay Listing From Employer">
        <span class="text-xs font-semibold text-red-500">Must update .xlxs fromat only</span>
        <div class="grid items-start grid-cols-3 gap-2 my-4">
            <x-datetime-picker
                label="Transaction Date"
                wire:model="txnDate"
                without-time=true
                display-format="DD/MM/YYYY"
                min="{{ $startDate }}"
                max="{{ $endDate }}"
            />
            <x-select
                label="Employer Name"
                placeholder="-- PLEASE SELECT --"
                wire:model.live="employerId"
            >
                @foreach ($employers as $employer)
                    <x-select.option label="{{ $employer->description }}" value="{{ $employer->description }}" />
                @endforeach
            </x-select>
            <x-input
                label="Document No"
                wire:model="docNo"
            />
        </div>
        @if($employerId)
            <div class="my-5">
                @if(!$dokumen)
                <input type="file" id="fileInput" class="hidden w-full" wire:model="dokumen" />
                @endif
                <label for="fileInput" class="flex items-center justify-center w-full h-24 py-4 border-2 border-dotted {{ (!$dokumen) ? 'cursor-pointer bg-gray-50 dark:border-gray-700 dark:bg-gray-800 rounded-xl border-primary-400' : 'bg-emerald-50 dark:border-emerald-700 dark:bg-emerald-800 rounded-xl border-emerald-400' }} ">
                    <div class="flex items-center justify-center space-x-2">
                        @if(!$dokumen)
                            <x-icon name="cloud-upload" class="w-5 h-5 text-primary-600 animate-bounce" />
                            <p class="text-xs leading-5 text-center text-primary-600">
                                Please choose document
                            </p>
                        @else
                            <x-icon name="cloud-download" class="w-5 h-5 text-emerald-600 animate-bounce" />
                            <p class="text-xs leading-5 text-center text-emerald-600">
                                {{ $dokumen->getClientOriginalName() }}
                            </p>
                            <x-icon name="trash" class="w-5 h-5 text-red-600 cursor-pointer" wire:click="clearFile" />
                        @endif
                    </div>
                </label>
            </div>
            <div class="grid items-start grid-cols-3 gap-2 mt-4">
                <x-datetime-picker
                    label="Transaction Date"
                    wire:model="txnDate"
                    without-time=true
                    display-format="DD/MM/YYYY"
                    min="{{ $startDate }}"
                    max="{{ $endDate }}"
                    disabled
                />
                <x-select
                    label="Employer Name"
                    placeholder="-- PLEASE SELECT --"
                    wire:model="employerId"
                    disabled
                >
                    @foreach ($employers as $employer)
                        <x-select.option label="{{ $employer->description }}" value="{{ $employer->description }}" />
                    @endforeach
                </x-select>
                <x-input
                    label="Document No"
                    wire:model="docNo"
                    disabled
                />
            </div>

            @if($dokumen)
                <x-slot name="footer">
                    <div class="flex items-center justify-end">
                        <x-button
                            sm
                            icon="cloud-upload"
                            primary
                            label="Upload"
                            wire:click="uploadExcel"
                        />
                    </div>
                </x-slot>
            @endif
        @endif
    </x-card>
</div>
