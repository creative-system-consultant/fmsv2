<?php

namespace App\Services\Model;

use App\Models\Ref\RefInstCode;

class InstCodesService
{
    public static function isCodeExists($code)
    {
        return RefInstCode::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllInstCode()
    {
        return RefInstCode::all();
    }

    public static function createInstCode($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefInstCode::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefInstCode::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateInstCode($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefInstCode::whereId($id)->update($mergedData);
    }

    public static function deleteInstCode($id)
    {
        RefInstCode::whereId($id)->delete();
    }

    public static function getInstCodeResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefInstCode::whereClientId(auth()->user()->client_id)
            ->orderBy('code','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }else{
            return RefInstCode::where(function ($query) use ($searchQuery) {
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