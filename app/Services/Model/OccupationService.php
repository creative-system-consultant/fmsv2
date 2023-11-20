<?php

namespace App\Services\Model;

use App\Models\Ref\RefOccupations;

class OccupationService
{
    public static function isOccupIdExists($occup_id)
    {
        return RefOccupations::whereClientId(auth()->user()->client_id)->whereOccupId($occup_id)->exists();
    }

    public static function getAllOccupations()
    {
        return RefOccupations::all();
    }

    public static function createOccupation($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefOccupations::create($mergedData);
    }

    public static function canUpdateOccupId($id, $occup_id)
    {
        $existingOccupId = RefOccupations::whereClientId(auth()->user()->client_id)->whereOccupId($occup_id);
        return !$existingOccupId->exists() || $existingOccupId->value('id') == $id;
    }

    public static function updateOccupation($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefOccupations::whereId($id)->update($mergedData);
    }

    public static function deleteOccupation($id)
    {
        RefOccupations::whereId($id)->delete();
    }
    
    public static function getOccupationResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefOccupations::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefOccupations::where(function ($query) use ($searchQuery) {
                $query->where('occup_id', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}