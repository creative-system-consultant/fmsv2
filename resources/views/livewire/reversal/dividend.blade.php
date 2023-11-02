<div>
    <x-reversal title="Dividen Reversal" :dataTable=$dataTable >
        <x-slot:searchBy >
            <x-native-select  wire:model.live="searchBy">
                <option value="FMS.DIVIDEN_STATEMENT.mbr_no">Membership No</option>
                <option value="FMS.DIVIDEN_STATEMENT.doc_no">Document No</option>
                <option value="CIF.CUSTOMERS.name">Name</option>
                <option value="FMS.DIVIDEN_STATEMENT.txn_date">Transaction Date</option>
            </x-native-select>
        </x-slot:searchBy>
    </x-reversal>
</div>
