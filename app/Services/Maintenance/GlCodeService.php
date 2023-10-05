<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefGlcode;

class GlCodeService
{
    public function isCodeExists($code)
    {
        return RefGlCode::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createGlCode($description, $code, $status)
    {
        RefGlCode::create([
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
        $existingCode = RefGlCode::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateGlcode($id, $description, $code, $status)
    {
        RefGlCode::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteGlcode($id)
    {
        RefGlCode::whereId($id)->delete();
    }

    public function getPaginatedGlcode($perPage = 10)
    {
        return RefGlCode::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}