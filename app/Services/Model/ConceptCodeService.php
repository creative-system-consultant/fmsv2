<?php

namespace App\Services\Model;

use App\Models\Ref\RefConceptCodes;

class ConceptCodeService
{
    public static function isCodeExists($priority)
    {
        return RefConceptCodes::whereClientId(auth()->user()->client_id)->whereCode($priority)->exists();
    }

    public static function getAllConceptCodes()
    {
        return RefConceptCodes::all();
    }

    public static function createConceptCode($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefConceptCodes::create($mergedData);
    }

    public static function canUpdateCode($id, $priority)
    {
        $existingCode = RefConceptCodes::whereClientId(auth()->user()->client_id)->whereCode($priority);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateConceptCode($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefConceptCodes::whereId($id)->update($mergedData);
    }

    public static function deleteConceptCode($id)
    {
        RefConceptCodes::whereId($id)->delete();
    }
    
    public static function getConceptCodeResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefConceptCodes::whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);}
        else
        {
            return RefConceptCodes::where(function ($query) use ($searchQuery) {
                $query->where('priority', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }  
}