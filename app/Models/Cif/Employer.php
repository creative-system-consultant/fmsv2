<?php

namespace App\Models\Cif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table   = 'CIF.CUSTOMERS_EMPLOYMENT';
    protected $guarded = [];

    public function address()
    {
        return $this->hasOne(Address::class, 'cif_id', 'cif_id')->where('address_type_id', 3);
    }

    public function getFaxNoAttribute()
    {
        $address = $this->address;

        if (!$address) {
            return null; // or a default value
        }

        return $address->fax;
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address;

        if (!$address) {
            return null; // or a default value
        }

        $fullAddress = trim($address->address1);

        if (!empty($address->address2)) {
            $fullAddress .= ', ' . trim($address->address2);
        }

        if (!empty($address->address3)) {
            $fullAddress .= ', ' . trim($address->address3);
        }

        $fullAddress .= ', ' . trim($address->postcode);
        $fullAddress .= ' ' . trim($address->town);

        // Fetch state description from the state relationship
        $stateDescription = $address->state ? $address->state->description : 'Unknown State';
        $fullAddress .= ', ' . $stateDescription;

        return $fullAddress;
    }
}
