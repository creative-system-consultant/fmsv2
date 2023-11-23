<?php

namespace App\Services\Model;

use App\Models\Ref\RefCustType;

class CustTypeService
{
    public static function isCodeExists($cust_type)
    {
        return RefCustType::whereClientId(auth()->user()->client_id)->where('cust_type', $cust_type)->exists();
    }

    public static function getAllCustType()
    {
        return RefCustType::all();
    }

    public static function createCustType($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefCustType::create($mergedData);
    }

    public static function canUpdateCode($id, $cust_type)
    {
        $existingCode = RefCustType::whereClientId(auth()->user()->client_id)->where('cust_type', $cust_type);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateCustType($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefCustType::whereId($id)->update($mergedData);
    }

    public static function deleteCustType($id)
    {
        RefCustType::whereId($id)->delete();
    }

    public static function getCustTypeResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefCustType::whereClientId(auth()->user()->client_id)
            ->orderBy('cust_type','ASC')
                ->paginate($perPage);
        }
        else
        {
            return RefCustType::where(function ($query) use ($searchQuery) {
                $query->where('cust_type', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}