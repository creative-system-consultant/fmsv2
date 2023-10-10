<?php

namespace App\Services\Model;

use App\Models\Ref\RefRelationship;

class RelationshipService
{
    public static function isCodeExists($code)
    {
        return RefRelationship::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public static function getAllRelationship()
    {
        return RefRelationship::all();
    }

    public static function createRelationship($data)
    {
        $defaultData = [
            'coop_id' => auth()->user()->coop_id,
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefRelationship::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefRelationship::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateRelationship($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefRelationship::whereId($id)->update($mergedData);
    }

    public static function deleteRelationship($id)
    {
        RefRelationship::whereId($id)->delete();
    }

    public static function getPaginatedRelationships($perPage = 10)
    {
        return RefRelationship::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}