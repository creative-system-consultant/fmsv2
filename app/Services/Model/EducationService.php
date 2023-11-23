<?php

namespace App\Services\Model;

use App\Models\Ref\RefEducation;

class EducationService
{
    public static function isCodeExists($code)
    {
        return RefEducation::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllEducation()
    {
        return RefEducation::all();
    }

    public static function createEducation($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefEducation::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefEducation::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateEducation($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefEducation::whereId($id)->update($mergedData);
    }

    public static function deleteEducation($id)
    {
        RefEducation::whereId($id)->delete();
    }
    
    public static function getEducationResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefEducation::whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefEducation::where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}