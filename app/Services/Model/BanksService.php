<?php

namespace App\Services\Model;

use App\Models\Ref\RefBank;

class BanksService
{
    public static function isCodeExists($code)
    {
        return RefBank::whereClientId(auth()->user()->client_id)->whereCode ($code)->exists();
    }

    public static function getAllBankService()
    {
        return RefBank::all();
    }

    public static function createBanksService($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefBank::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefBank::whereClientId(auth()->user()->client_id)->whereCode ($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateBanksService($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefBank::whereId($id)->update($mergedData);
    }

    public static function deleteBanksService($id)
    {
        RefBank::whereId($id)->delete();
    }
    
    public static function getBanksResult($searchQuery, $orderBy, $perPage = 10)
    {
        $query = RefBank::whereClientId(auth()->user()->client_id);
    
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('code', 'like', $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // Dynamically add order by clause based on the selected column
        switch ($orderBy) {
            case 'code':
                $query->orderBy('code', 'ASC');
                break;
            case 'description':
                $query->orderBy('description');
                break;
            case 'priority':
                $query->orderBy('priority');
                break;
            case 'status':
                $query->orderBy('status');
                break;
            case 'bank_client':
                $query->orderBy('bank_client');
                break;
            default:
                $query->orderBy('priority')->orderBy('code')->orderBy('description');
                break;
        }
    
        return $query->paginate($perPage);
    }
    
}