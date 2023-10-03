<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefGender;

class GenderService
{
    public function isCodeExists($code)
    {
        return RefGender::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createGender($description, $code, $status)
    {
        RefGender::create([
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
        $existingCode = RefGender::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateGender($id, $description, $code, $status)
    {
        RefGender::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteGender($id)
    {
        RefGender::whereId($id)->delete();
    }

    public function getPaginatedGender($perPage = 10)
    {
        return RefGender::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}