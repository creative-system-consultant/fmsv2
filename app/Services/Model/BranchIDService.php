<?php

namespace App\Services\Model;

use App\Models\Ref\RefBranchID;

class BranchIDService
{
    
    public static function isCodeExists($branch_id)
    {
        return RefBranchID::whereClientId(auth()->user()->client_id)->where ('branch_id', $branch_id)->exists();
    }

    public static function getAllBranchIDService()
    {
        return RefBranchID::all();
    }

    public static function createBranchIDService($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefBranchID::create($mergedData);
    }

    public static function canUpdateCode($id, $branch_id)
    {
        $existingCode = RefBranchID::whereClientId(auth()->user()->client_id)->where ('branch_id', $branch_id);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateBranchIDService($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefBranchID::whereId($id)->update($mergedData);
    }

    public static function deleteBranchIDService($id)
    {
        RefBranchID::whereId($id)->delete();
    }

    public static function getBranchIDResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefBranchID::whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('branch_id','ASC')
            ->orderBy('branch_name','ASC')
            ->paginate($perPage);
        } else {
            return RefBranchID::where(function ($query) use ($searchQuery) {
                $query->where('branch_id', 'like', $searchQuery . '%')
                        ->orWhere('branch_name', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}