<?php

namespace App\Services\Model;

use App\Models\Ref\RefInstMode;

class InstModesService
{
    public static function isCodeExists($code)
    {
        return RefInstMode::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllInstMode()
    {
        return RefInstMode::all();
    }

    public static function createInstMode($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefInstMode::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefInstMode::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateInstMode($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefInstMode::whereId($id)->update($mergedData);
    }

    public static function deleteInstMode($id)
    {
        RefInstMode::whereId($id)->delete();
    }

    public static function getInstModeResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefInstMode::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefInstMode::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}