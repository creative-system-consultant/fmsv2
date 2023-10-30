<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefMarital;

class MaritalService
{
    public function isCodeExists($code)
    {
        return RefMarital::whereclientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public function createMarital($description, $code, $status)
    {
        RefMarital::create([
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
        $existingCode = RefMarital::whereclientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateMarital($id, $description, $code, $status)
    {
        RefMarital::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteMarital($id)
    {
        RefMarital::whereId($id)->delete();
    }

    public function getPaginatedMarital($perPage = 10)
    {
        return RefMarital::whereclientId(auth()->user()->client_id)->paginate($perPage);
    }
}