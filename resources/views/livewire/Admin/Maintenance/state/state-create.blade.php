

<div>
    <h1 class="text-base font-semibold md:text-2xl"></h1>
    <x-container title="State Create Information" routeBackBtn="" titleBackBtn="" disableBackBtn="">
        <div class="flex mt-1 mb-2 rounded-md gap-3">
            <x-native-select
             label="State"
             placeholder="Select State"
              :options="['JOHOR', 'KELANTAN', 'KEDAH', 'MALACCA', 'NEGERI SEMBILAN','PERLIS','PENANG','
              PERAK', 'PAHANG','SELANGOR','SABAH','SARAWAK','TERENGGANU','W.P. KUALA LUMPUR','W.P. PUTRAJAYA']"
              wire:model="description"
                />
            <x-input wire:model="code" label="Code" placeholder="" />
        </div>
            <x-toggle left-label="Status" wire:model.defer="status" />
        <div>
            <x-button wire:click="cancel" squared label="Cancel" />
            <x-button wire:click="submit" squared positive label="Submit" />
        </div>
    </x-container>
</div>




