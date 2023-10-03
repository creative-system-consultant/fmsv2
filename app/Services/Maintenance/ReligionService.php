<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefReligion;

class ReligionService
{
    public function isCodeExists($code)
    {
        return RefReligion::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createReligion($description, $code, $status)
    {
        RefReligion::create([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'coop_id' => auth()->user()->coop_id,
            'status' => $status == true ? '1' : '0',
            'created_at' => now(),
            'created_by' => auth()->user()->name,
        ]);
    }

    public function canUpdateCode($id, $code)
    {
        $existingCode = RefReligion::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateReligion($id, $description, $code, $status)
    {
        RefReligion::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteReligion($id)
    {
        RefReligion::whereId($id)->delete();
    }

    public function getPaginatedReligions($perPage = 10)
    {
        return RefReligion::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}