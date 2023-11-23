<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefGender;

class GenderService
{
    public function isInstituteIdExists($institute_id)
    {
        return RefGender::whereClientId(auth()->user()->client_id)->whereInstituteId($institute_id)->exists();
    }

    public function createGender($description, $institute_id)
    {
        RefGender::create([
            'description' => trim(strtoupper($description)),
            'institute_id' => trim(strtoupper($institute_id)),
            'client_id' => auth()->user()->client_id,
            'created_at' => now(),
            'created_by' => auth()->id(),
        ]);
    }

    public function canUpdateInstituteId($id, $institute_id)
    {
        $existingInstituteId = RefGender::whereClientId(auth()->user()->client_id)->whereInstituteId($institute_id);

        return !$existingInstituteId->exists() || $existingInstituteId->value('id') == $id;
    }

    public function updateGender($id, $description, $institute_id)
    {
        RefGender::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'institute_id' => trim(strtoupper($institute_id)),
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ]);
    }

    public function deleteGender($id)
    {
        RefGender::whereId($id)->delete();
    }

    public function getPaginatedGender($perPage = 10)
    {
        return RefGender::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}