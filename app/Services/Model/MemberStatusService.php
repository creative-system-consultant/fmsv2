<?php

namespace App\Services\Model;

use App\Models\Ref\RefMemStatus;
use Illuminate\Support\Facades\Validator;

class MemberStatusService
{
    public static function isCodeExists($mbr_status)
    {
        return RefMemStatus::whereClientId(auth()->user()->client_id)->where ('mbr_status', $mbr_status)->exists();
    }

    //  Fetches all MemberStatusService from the database.
    public static function getAllMemberStatusService()
    {
        return RefMemStatus::all();
    }
    // Creates a new MemberStatusService entry in the database.
    public static function createMemberStatusService($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefMemStatus::create($mergedData);
    }
    
    public static function canUpdateCode($id, $mbr_status)
    {
        $existingCode = RefMemStatus::whereClientId(auth()->user()->client_id)->where ('mbr_status', $mbr_status);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    // Updates an existing MemberStatusService's data by key.
    public static function updateMemberStatusService($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefMemStatus::whereId($id)->update($mergedData);
    }
    // Deletes a MemberStatusService by their key.
    public static function deleteMemberStatusService($id)
    {
        RefMemStatus::whereId($id)->delete();
    }
    public static function getMemStatusResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefMemStatus::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefMemStatus::where(function ($query) use ($searchQuery) {
                $query->where('mbr_status', 'like',  $searchQuery . '%')
                        ->orWhere('description', 'like', '%'. $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}