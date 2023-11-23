<?php

namespace App\Services\Model;

use App\Models\Ref\RefGuarantorStatus;

class GuarantorStatusService
{
    public static function isCodeExists($code)
    {
        return RefGuarantorStatus::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllGuarantorStatus()
    {
        return RefGuarantorStatus::all();
    }

    public static function createGuarantorStatus($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefGuarantorStatus::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefGuarantorStatus::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateGuarantorStatus($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefGuarantorStatus::whereId($id)->update($mergedData);
    }

    public static function deleteGuarantorStatus($id)
    {
        RefGuarantorStatus::whereId($id)->delete();
    }

    public static function getGuarantorResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefGuarantorStatus::whereClientId(auth()->user()->client_id)
            ->orderBy('code','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefGuarantorStatus::where(function ($query) use ($searchQuery) {
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