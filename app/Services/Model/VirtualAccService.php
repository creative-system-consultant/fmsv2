<?php

namespace App\Services\Model;

use App\Models\Fms\FmsGlobalParm;

class VirtualAccService
{

    public static function getAllVirtualAcc()
    {
        return FmsGlobalParm::all();
    }


    public static function updateVirtualAcc($data)
    {  
        if (!empty($data)) {
        FmsGlobalParm::whereClientId(auth()->user()->client_id)->update($data);
        }
    }

    public static function updateCoolingPeriod($valueCoolingPeriod)
    {
         // Assuming $data contains only 'COOLING_PERIOD' key and value
        FmsGlobalParm::whereClientId(auth()->user()->client_id)->update(['COOLING_PERIOD' => $valueCoolingPeriod]);
    }


    public static function updateThreshold($valueThreshold)
    {
         // Assuming $data contains only 'COOLING_PERIOD' key and value
        FmsGlobalParm::whereClientId(auth()->user()->client_id)->update(['THRESHOLD' => $valueThreshold]);
    }

    public static function getVirtualAccResult($searchQuery, $perPage = 10)
    {

        if($searchQuery == '')
        {
            return FmsGlobalParm::whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }else{
            return FmsGlobalParm::where(function ($query) use ($searchQuery) {
                $query->where('COOLING_PERIOD','like','%'.$searchQuery.'%')
                ->where('THRESHOLD','like','%'.$searchQuery.'%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}