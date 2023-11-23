<?php

namespace App\Services\Model;

use App\Models\Ref\RefPaymentType;

class PaymentTypeService
{

    public static function isCodeExists($description)
    {
        return RefPaymentType::whereClientId(auth()->user()->client_id)->where('description', $description)->exists();
    }

    public static function getAllPaymentType()
    {
        return RefPaymentType::all();
    }

    public static function createPaymentType($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefPaymentType::create($mergedData);
    }

    public static function canUpdatePaymentType($id, $description)
    {
        $existingCode = RefPaymentType::whereClientId(auth()->user()->client_id)->where('description', $description);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updatePaymentType($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($defaultData, $data);
        RefPaymentType::whereId($id)->update($mergedData);
    }

    public static function deletePaymentType($id)
    {
        RefPaymentType::whereId($id)->delete();
    }

    public static function getPaymentTypeResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefPaymentType::whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefPaymentType::where(function ($query) use ($searchQuery) {
                $query ->Where('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}