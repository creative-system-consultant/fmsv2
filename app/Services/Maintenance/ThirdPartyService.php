<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefThirdParty;

class ThirdPartyService
{
    public static function isTrxCodeExists($trx_code)
    {
        return RefThirdParty::whereClientId(auth()->user()->client_id)->whereTrxCode($trx_code)->exists();
    }

    public static function getAllThirdParty()
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

    public static function getPaginatedThirdPartys($perPage = 10)
    {
        return RefThirdParty::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}