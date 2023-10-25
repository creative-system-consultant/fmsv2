<?php

namespace App\Services\Model;

use App\Models\Ref\RefRace;

class RaceService
{
    public static function isCodeExists($code)
    {
        return RefRace::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllRace()
    {
        return RefRace::all();
    }

    public static function createRace($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefRace::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefRace::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateRace($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefRace::whereId($id)->update($mergedData);
    }

    public static function deleteRace($id)
    {
        RefRace::whereId($id)->delete();
    }

    public static function getPaginatedRace($perPage = 10)
    {
        return RefRace::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}