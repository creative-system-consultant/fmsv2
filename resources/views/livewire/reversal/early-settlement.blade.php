<div>
    <x-reversal title="Early Settlement Reversal" :dataTable=$dataTable >
        <x-slot:searchBy >
            <x-native-select  wire:model.live="searchBy">
                <option value="FMS.ACCOUNT_STATEMENTS.account_no">Account No</option>
                <option value="FMS.ACCOUNT_STATEMENTS.doc_no">Document No</option>
                <option value="CIF.CUSTOMERS.name">Name</option>
                <option value="FMS.ACCOUNT_MASTERS.mbr_no">Membership No</option>
                <option value="FMS.ACCOUNT_STATEMENTS.transaction_date">Transaction Date</option>
            </x-native-select>
        </x-slot:searchBy>
    </x-reversal>
</div>
