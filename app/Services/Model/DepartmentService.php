<?php

namespace App\Services\Model;

use App\Models\Ref\RefDepartment;

class DepartmentService
{
    public static function isCodeExists($dept_kod)
    {
        return RefDepartment::whereClientId(auth()->user()->client_id)->where('dept_kod', $dept_kod)->exists();
    }

    public static function getAllDepartment()
    {
        return RefDepartment::all();
    }

    public static function createDepartment($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefDepartment::create($mergedData);
    }

    public static function canUpdateCode($id, $dept_kod)
    {
        $existingCode = RefDepartment::whereClientId(auth()->user()->client_id)->where('dept_kod', $dept_kod);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateDepartment($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefDepartment::whereId($id)->update($mergedData);
    }

    public static function deleteDepartment($id)
    {
        RefDepartment::whereId($id)->delete();
    }

    public static function getDepartmentResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefDepartment::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefDepartment::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query->where('dept_kod', 'like', $searchQuery . '%')
                        ->orWhere('dept_desc', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}