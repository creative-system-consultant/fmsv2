<?php

namespace App\Services\Model;

use App\Models\Ref\RefState;

class StateService
{
    public static function isCodeExists($code)
    {
        return RefState::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllState()
    {
        return RefState::all();
    }

    public static function createState($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefState::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefState::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateState($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);

        RefState::whereId($id)->update($mergedData);
    }

    public static function deleteState($id)
    {
        RefState::whereId($id)->delete();
    }

    public static function getPaginatedStates($perPage = 10)
    {
        return RefState::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}