<?php

namespace App\Services\Model;

use App\Models\Ref\RefCustStatus;

class CustStatusService
{
    public static function isCodeExists($description)
    {
        return RefCustStatus::whereClientId(auth()->user()->client_id)->where('description', $description)->exists();
    }

    public static function getAllCustStatus()
    {
        return RefCustStatus::all();
    }

    public static function createCustStatus($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefCustStatus::create($mergedData);
    }

    public static function canUpdateStatus($id, $description)
    {
        $existingCode = RefCustStatus::whereClientId(auth()->user()->client_id)->where('description', $description);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateCustStatus($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($defaultData, $data);
        RefCustStatus::whereId($id)->update($mergedData);
    }

    public static function deleteCustStatus($id)
    {
        RefCustStatus::whereId($id)->delete();
    }

    public static function getCustStatusResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefCustStatus::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefCustStatus::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query ->Where('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}