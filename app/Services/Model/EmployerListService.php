<?php

namespace App\Services\Model;

use App\Models\Ref\RefEmployerList;

class EmployerListService
{
    public static function isCodeExists($employer_id)
    {
        return RefEmployerList::whereClientId(auth()->user()->client_id)->where('employer_id', $employer_id)->exists();
    }

    public static function getAllEmployerList()
    {
        return RefEmployerList::all();
    }

    public static function createEmployerList($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefEmployerList::create($mergedData);
    }

    public static function canUpdateCode($id, $employer_id)
    {
        $existingCode = RefEmployerList::whereClientId(auth()->user()->client_id)->where('employer_id', $employer_id);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateEmployerList($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefEmployerList::whereId($id)->update($mergedData);
    }

    public static function deleteEmployerList($id)
    {
        RefEmployerList::whereId($id)->delete();
    }

    public static function getEmployerListResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefEmployerList::whereClientId(auth()->user()->client_id)
            ->orderBy('employer_id','ASC')
            ->orderBy('employer_name','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefEmployerList::where(function ($query) use ($searchQuery) {
                $query->where('employer_id', 'like', '%'. $searchQuery . '%')
                        ->orWhere('employer_name', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('employer_id','ASC')
            ->orderBy('employer_name','ASC')
            ->paginate($perPage);
        }
    }
    
}