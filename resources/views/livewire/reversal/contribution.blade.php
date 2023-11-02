<div>
    <x-reversal title="Contribution Reversal" :dataTable=$dataTable >
        <x-slot:searchBy >
            <x-native-select  wire:model.live="searchBy">
                <option value="FMS.MEMBERSHIP_STATEMENTS.mbr_no">Membership No</option>
                <option value="FMS.MEMBERSHIP_STATEMENTS.doc_no">Document No</option>
                <option value="CIF.CUSTOMERS.name">Name</option>
                <option value="FMS.MEMBERSHIP_STATEMENTS.transaction_date">Transaction Date</option>
            </x-native-select>
        </x-slot:searchBy>
    </x-reversal>
</div>
