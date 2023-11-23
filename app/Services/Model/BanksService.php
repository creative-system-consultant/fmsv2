<?php

namespace App\Services\Model;

use App\Models\Ref\RefBank;

class BanksService
{
    public static function isCodeExists($code)
    {
        return RefBank::whereClientId(auth()->user()->client_id)->whereCode ($code)->exists();
    }

    public static function getAllBankService()
    {
        return RefBank::all();
    }

    public static function createBanksService($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefBank::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefBank::whereClientId(auth()->user()->client_id)->whereCode ($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateBanksService($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefBank::whereId($id)->update($mergedData);
    }

    public static function deleteBanksService($id)
    {
        RefBank::whereId($id)->delete();
    }
    
    public static function getBanksResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefBank::whereClientId(auth()->user()->client_id)
                ->orderBy('priority','ASC')
                ->orderBy('code','ASC')
                ->orderBy('description','ASC')
                ->paginate($perPage);
        } else {
            return RefBank::where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })
                ->whereClientId(auth()->user()->client_id)
                ->orderBy('priority','ASC')
                ->orderBy('code','ASC')
                ->orderBy('description','ASC')
                ->paginate($perPage);
        }
    }
}