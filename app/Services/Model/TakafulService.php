<?php

namespace App\Services\Model;

use App\Models\Ref\RefTakaful;

class TakafulService
{
    public static function isCodeExists($code)
    {
        return RefTakaful::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllTakafulService()
    {
        return RefTakaful::all();
    }

    public static function createTakaful($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefTakaful::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefTakaful::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateTakaful($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefTakaful::whereId($id)->update($mergedData);
    }

    public static function deleteTakaful($id)
    {
        RefTakaful::whereId($id)->delete();
    }

    public static function getTakafulResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefTakaful::whereClientId(auth()->user()->client_id)
            ->orderBy('code','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefTakaful::where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('code','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}