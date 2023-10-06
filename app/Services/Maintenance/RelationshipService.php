<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefRelationship;

class RelationshipService
{
    public function isCodeExists($code)
    {
        return RefRelationship::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createRelationship($description, $code, $status)
    {
        RefRelationship::create([
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
        $existingCode = RefRelationship::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateRelationship($id, $description, $code, $status)
    {
        RefRelationship::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteRelationship($id)
    {
        RefRelationship::whereId($id)->delete();
    }

    public function getPaginatedRelationship($perPage = 10)
    {
        return RefRelationship::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}