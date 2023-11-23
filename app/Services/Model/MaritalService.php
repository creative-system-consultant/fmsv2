<?php

namespace App\Services\Model;

use App\Models\Ref\RefMarital;

class MaritalService
{
    public static function isCodeExists($code)
    {
        return RefMarital::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllMarital()
    {
        return RefMarital::all();
    }

    public static function createMarital($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefMarital::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefMarital::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateMarital($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefMarital::whereId($id)->update($mergedData);
    }

    public static function deleteMarital($id)
    {
        RefMarital::whereId($id)->delete();
    }
    
    public static function getMaritalResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefMarital::whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefMarital::where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}