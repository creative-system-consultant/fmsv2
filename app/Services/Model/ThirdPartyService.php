<?php

namespace App\Services\Model;

use App\Models\Ref\RefThirdParty;

class ThirdPartyService
{
    public static function isTrxCodeExists($trx_code)
    {
        return RefThirdParty::whereClientId(auth()->user()->client_id)->whereTrxCode($trx_code)->exists();
    }

    public static function getAllThirdPartys()
    {
        return RefThirdParty::all();
    }

    public static function createThirdParty($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefThirdParty::create($mergedData);
    }

    public static function canUpdateTrxCode($id, $trx_code)
    {
        $existingTrxCode = RefThirdParty::whereClientId(auth()->user()->client_id)->whereTrxCode($trx_code);
        return !$existingTrxCode->exists() || $existingTrxCode->value('id') == $id;
    }

    public static function updateThirdParty($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefThirdParty::whereId($id)->update($mergedData);
    }

    public static function deleteThirdParty($id)
    {
        RefThirdParty::whereId($id)->delete();
    }
    
    public static function getThirdPartyResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefThirdParty::whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefThirdParty::where(function ($query) use ($searchQuery) {
                $query->where('trx_code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}