<?php

namespace App\Services\Model;

use App\Models\Ref\RefPosition;

class PositionService
{
    public static function isCodeExists($code)
    {
        return RefPosition::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllPositionService()
    {
        return RefPosition::all();
    }

    public static function createPositionService($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefPosition::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefPosition::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updatePositionService($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefPosition::whereId($id)->update($mergedData);
    }

    public static function deletePositionService($id)
    {
        RefPosition::whereId($id)->delete();
    }

    public static function getPositionResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefPosition::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefPosition::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}