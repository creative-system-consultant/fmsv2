<?php

namespace App\Services\Model;

use App\Models\Ref\RefIncome;

class IncomeService
{
    public static function isCodeExists($code)
    {
        return RefIncome::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllIncome()
    {
        return RefIncome::all();
    }

    public static function createIncome($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefIncome::create($mergedData);
    }
    
    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefIncome::whereClientId(auth()->user()->client_id)->whereCode ($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateIncome($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefIncome::whereId($id)->update($mergedData);
    }
    
    public static function deleteIncome($id)
    {
        RefIncome::whereId($id)->delete();
    }

    public static function getIncomeResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefIncome::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefIncome::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query->where('code', 'like',  $searchQuery . '%')
                        ->orWhere('description', 'like', '%'. $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}