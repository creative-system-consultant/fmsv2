<?php

namespace App\Services\Model;

use App\Models\Ref\RefReligion;

class ReligionService
{
    public static function isCodeExists($code)
    {
        return RefReligion::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllReligion()
    {
        return RefReligion::all();
    }

    public static function createReligion($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefReligion::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefReligion::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateReligion($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefReligion::whereId($id)->update($mergedData);
    }

    public static function deleteReligion($id)
    {
        RefReligion::whereId($id)->delete();
    }

    public static function getPaginatedReligions($perPage = 10)
    {
        return RefReligion::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}