<?php

namespace App\Services\Model;

use App\Models\Ref\RefFinancingRule;

class FinancingRuleService
{
    public static function isCodeExists($code)
    {
        return RefFinancingRule::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllFinancingRule()
    {
        return RefFinancingRule::all();
    }

    public static function createFinancingRule($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefFinancingRule::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefFinancingRule::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateFinancingRule($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefFinancingRule::whereId($id)->update($mergedData);
    }

    public static function deleteFinancingRule($id)
    {
        RefFinancingRule::whereId($id)->delete();
    }
    
    public static function getFinancingRuleResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefFinancingRule::whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        
        }
        else
        {
            return RefFinancingRule::where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}