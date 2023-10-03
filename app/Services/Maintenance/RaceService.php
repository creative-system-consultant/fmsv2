<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefRace;

class RaceService
{
    public function isCodeExists($code)
    {
        return RefRace::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createRace($description, $code, $status)
    {
        RefRace::create([
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
        $existingCode = RefRace::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateRace($id, $description, $code, $status)
    {
        RefRace::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteRace($id)
    {
        RefRace::whereId($id)->delete();
    }

    public function getPaginatedRace($perPage = 10)
    {
        return RefRace::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}