<?php

namespace App\Services\Model;

use App\Models\Fms\FmsGlobalParm;

class VirtualAccService
{

    public static function getAllVirtualAcc()
    {
        return FmsGlobalParm::all();
    }

    
    public static function getValue()
    {
        return FmsGlobalParm::whereClientId(auth()->user()->client_id)
        ->select('COOLING_PERIOD', 'THRESHOLD')
        ->first();
    }

    public static function canUpdateCoolingPeriod($id, $valueCoolingPeriod)
    {
        $existingValue = FmsGlobalParm::whereClientId(auth()->user()->client_id)->where('COOLING_PERIOD',$valueCoolingPeriod);
        return !$existingValue->exists() || $existingValue->value('id') == $id;
    }
    public static function updateCoolingPeriod($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        FmsGlobalParm::whereId($id)->update($mergedData);
    }

    public static function getVirtualAccResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return FmsGlobalParm::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return FmsGlobalParm::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query->where('COOLING_PERIOD', 'like', $searchQuery . '%')
                        ->orWhere('THRESHOLD', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}