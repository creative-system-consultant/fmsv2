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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Staff No." 
                    placeholder="staff no." 
                    wire:model="staffNo" 
                    :disabled="true" 
                />
            
                <x-input 
                    label="Membership No." 
                    placeholder=""
                    wire:model="membershipNo" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Name" 
                    placeholder=""  
                    wire:model="name" 
                />
            
                <x-input 
                    label="Identity Number(IC)" 
                    placeholder=""  
                    wire:model="identityNumber"
                />
            
                <x-input 
                    label="Category" 
                    placeholder=""  
                    wire:model="category" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Type" 
                    placeholder=""  
                    wire:model="type" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Status" 
                    placeholder=""  
                    wire:model="status"
                />
            
                <x-input 
                    label="Apply Date" 
                    placeholder=""  
                    wire:model="applyDate" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Join Date" 
                    placeholder="" 
                    wire:model="joinDate" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Start Date" 
                    placeholder=""  
                    wire:model="startDate" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Status Changed Date"
                    placeholder="" 
                    wire:model="statusChangedDate" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Approved Retirement Date" 
                    placeholder="" 
                    wire:model="approvedRetirementDate"
                />
            
                <x-input 
                    label="Effective Retirement Date" 
                    placeholder=""  
                    wire:model="effectiveRetirementDate"
                />
            
                <x-input 
                    label="Entrance Fee" 
                    placeholder=""  
                    wire:model="entranceFee" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Entrance Fee Date" 
                    placeholder=""  
                    wire:model="entranceFeeDate" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Introducer Name" 
                    placeholder=""  
                    wire:model="introducerName" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Introducer Membership ID" 
                    placeholder=""  
                    wire:model="introducerMembershipID" 
                    :disabled="true"
                />
            
                <x-input 
                    label="Introducer IC" 
                    placeholder=""
                    wire:model="introducerIC"
                />
            
                <x-input 
                    label="Bank" 
                    placeholder=""   
                    wire:model="bank"
                />
            
                <x-input 
                    label="Bank Account No." 
                    placeholder=""  
                    wire:model="bankAccountNo"
                />
            
                <x-input 
                    label="Payment Type" 
                    placeholder=""   
                    wire:model="paymentType"
                />
            
                <x-input 
                    label="Payer Staff No" 
                    placeholder=""   
                    wire:model="payerStaffNo"
                />
            
                <x-input 
                    label="Virtual Account" 
                    placeholder=""  
                    wire:model="virtualAccount" 
                    :disabled="true"
                />
            </div>
            
        </x-card>
    </div>

    <!-- Member's Information -->
    <div class="mt-6">
        <x-card title="Member's Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Title" 
                    placeholder=""  
                    disabled
                />
                <x-input 
                    label="Name" 
                    placeholder=""  
                    wire:model="name"
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
                    wire:model="identityNumber"
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
                    wire:model="email"
                />
                <x-input 
                    label="Email Secondary" 
                    placeholder=""   
                    wire:model=""
                />
                <x-input 
                    label="Hand Phone No." 
                    placeholder=""   
                    wire:model="mobileNo"
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
                    wire:model="monthlyContribution"
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input 
                    label="Company Name" 
                    placeholder=""   
                    wire:model="cName"
                />
                <x-input 
                    label="Company Address" 
                    placeholder=""   
                    wire:model="cAddress"
                />
                <x-input 
                    label="Company Phone Number" 
                    placeholder=""   
                    wire:model="cOffice_num"
                />
                <x-input 
                    label="Company Fax Number" 
                    placeholder=""   
                    wire:model="cFax_num"
                />
                <x-input 
                    label="Job Group" 
                    placeholder=""  
                    wire:model="cDepartment"
                />
                <x-input 
                    label="Job Status" 
                    placeholder=""   
                    wire:model="cJob_status"
                />
                <x-input 
                    label="Position" 
                    placeholder=""   
                    wire:model="cPosition"
                />
                <x-input 
                    label="Employment Date" 
                    placeholder=""   
                    wire:model="cEmployment_date"
                />
                <x-input 
                    label="Salary" 
                    placeholder=""  
                    wire:model="cSalary"
                />
            </div>
        </x-card>
    </div>
</div>

