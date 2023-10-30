<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefCountry;

class CountryService
{
    public function isCodeExists($code)
    {
        return RefCountry::whereclientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public function createCountry($description, $code, $status)
    {
        RefCountry::create([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'client_id' => auth()->user()->client_id,
            'status' => $status == true ? '1' : '0',
            'created_at' => now(),
            'created_by' => auth()->user()->name,
        ]);
    }

    public function canUpdateCode($id, $code)
    {
        $existingCode = RefCountry::whereclientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateCountry($id, $description, $code, $status)
    {
        RefCountry::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteCountry($id)
    {
        RefCountry::whereId($id)->delete();
    }

    public function getPaginatedCountry($perPage = 10)
    {
        return RefCountry::whereclientId(auth()->user()->client_id)->paginate($perPage);
    }
}