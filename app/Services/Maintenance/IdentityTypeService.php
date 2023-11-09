<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefIdentityType;

class IdentityTypeService
{
    public static function isTypeExists($type)
    {
        return RefIdentityType::whereClientId(auth()->user()->client_id)->whereType($type)->exists();
    }

    public static function getAllIdentityType()
    {
        return RefIdentityType::all();
    }

    public static function createIdentityType($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        RefIdentityType::create($mergedData);
    }

    public static function canUpdateType($id, $type)
    {
        $existingType = RefIdentityType::whereClientId(auth()->user()->client_id)->whereType($type);

        return !$existingType->exists() || $existingType->value('id') == $id;
    }

    public static function updateIdentityType($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        RefIdentityType::whereId($id)->update($mergedData);
    }

    public static function deleteIdentityType($id)
    {
        RefIdentityType::whereId($id)->delete();
    }

    public static function getPaginatedIdentityTypes($perPage = 10)
    {
        return RefIdentityType::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}