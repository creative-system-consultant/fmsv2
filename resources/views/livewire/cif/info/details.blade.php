<div>

    <!-- Membership Overview -->
    <div class="mt-6">
        <x-card title="Membership Overview" >
            <x-slot name="action" >
                <div class="flex items-center justify-center space-x-2">
                    <x-button primary label="Close Membership Document" sm />
                    <x-button wire:click="editDetail" icon="pencil" primary label="Edit" sm />
                    <x-button icon="save" primary label="Save" sm/>
                </div>
            </x-slot>
            <div class="grid grid-cols-1 md:grid-cols-3  gap-5">
                <x-input 
                    label="Staff No." 
                    placeholder="staff no." 
                    disabled
                />
                <x-input 
                    label="Membership No. " 
                    placeholder="" 
                    disabled
                />
                <x-input 
                    label="Name" 
                    placeholder=""  
                    wire:model="" 
                />
                <x-input 
                    label="Indetity Number(IC) " 
                    placeholder=""  
                    wire:model=""
                />
                <x-input 
                    label="Category." 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Type" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Status" 
                    placeholder=""  
                    wire:model=""
                />
                <x-input 
                    label="Apply Date" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Join Date" 
                    placeholder="" 
                    disabled
                />
                <x-input 
                    label="Start Date" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Status Changed Date"
                    placeholder="" 
                    disabled
                />
                <x-input 
                    label="Approved Retirement Date" 
                    placeholder="" 
                    wire:model=""
                />
                <x-input 
                    label="Effective Retirement Date" 
                    placeholder=""  
                    wire:model=""
                />
                <x-input 
                    label="Entrance Fee" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Entrance Fee Date" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Introducer Name" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Introducer Membership ID" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Introducer IC" 
                    placeholder=""
                />
                <x-input 
                    label="Bank" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Bank Account No." 
                    placeholder=""  
                    wire:model=""
                />
                <x-input 
                    label="Payment Type" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Payer Staff No" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Virtual Account" 
                    placeholder=""  
                    disabled
                />
            </div>
        </x-card>
    </div>

    <!-- Member's Information -->
    <div class="mt-6">
        <x-card title="Member's Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <x-input 
                    label="Title" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Name" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Identity Type" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Identity No" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Other ID Type" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Other ID" 
                    placeholder=""
                />
                <x-input 
                    label="Email" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Email Secondary" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Hand Phone No." 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Resident Phone No." 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Gender" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Birth Date" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Race" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Bumiputra Status" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Languages" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Marital" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Citizenship" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Monthly Contribution" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Year Tabung Khairat" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Tabung Khairat" 
                    placeholder=""  
                    disabled
                />
            </div>
        </x-card>
    </div>

    <!-- Employer Information -->
    <div class="mt-6">
        <x-card title="Employer Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <x-input 
                    label="Company Name" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Company Address" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Company Phone Number" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Company Fax Number" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Job Group" 
                    placeholder=""  
                    wire:model=""
                />
                <x-input 
                    label="Job Status" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Position" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Employment Date" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Salary" 
                    placeholder=""  
                    wire:model=""
                />
            </div>
        </x-card>
    </div>
</div>

