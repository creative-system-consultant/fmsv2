<div>
    <div class="grid grid-cols-1">
        <div class="w-full p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700">
            <div class="flex items-start justify-normal  flex-col-reverse lg:justify-between xl:flex-row">
                <div class="flex flex-col items-start w-full space-x-0 space-y-2 md:flex-row md:items-center md:space-x-2 md:space-y-0">
                    <div class="w-full md:w-96">
                        <x-input
                            label="Name :"
                            wire:model="name"
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-input
                            label="Account No :"
                            wire:model="accountNo"
                            disabled
                        />
                    </div>
                    <div class="w-full md:w-64">
                        <x-inputs.currency
                            class="!pl-[2.5rem]"
                            label="Advance Amount :"
                            prefix="RM"
                            thousands=","
                            decimal="."
                            wire:model="advAmount"
                            disabled
                        />
                    </div>
                </div>
                <div class="mt-0 mb-2 xl:mb-2 xl:mt-7">
                    <x-button
                        class="w-32"
                        xs
                        outline
                        black
                        icon="arrow-left"
                        label="Back To List"
                        wire:click="redirectBack"
                    />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 py-4 mt-4 rounded-lg dark:bg-gray-900" x-data="{ tab: 0 }">
            <div class="col-span-12 lg:col-span-4 xxl:col-span-4">
                <x-card title="Category">
                    <x-tab.basic-title name="0">
                        <x-icon name="user-circle" class="w-6 h-6 mr-2"/>
                        Pay to Members
                    </x-tab.basic-title>
                </x-card>
            </div>
            <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
                <livewire:teller.refund-advance.category.pay-to-member :accountNo="$accountNo"/>
            </div>
        </div>
    </div>
</div>
