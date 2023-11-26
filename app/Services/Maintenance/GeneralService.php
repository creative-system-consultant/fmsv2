<?php

namespace App\Services\Maintenance;

class GeneralService
{
    public static function isCodeExists($model, $code)
    {
        return $model::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function canUpdateCode($model, $id, $code)
    {
        $existingCode = $model::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function getPaginated($model, $perPage = 10, $searchQuery = '', $orderByArray = [])
    {
        $query = $model::whereClientId(auth()->user()->client_id);

        if ($searchQuery != '') {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('code', 'like', $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            });
        }

        if (!empty($orderByArray)) {
            foreach ($orderByArray as $orderBy => $orderDirection) {
                $query->orderBy($orderBy, $orderDirection);
            }
        } else {
            // Default ordering if no specific order is requested
            $query->orderBy('description', 'ASC');
        }

        // if ($priority == true) {
        //     return $query->orderBy('priority', 'ASC')
        //         ->orderBy('description', 'ASC')
        //         ->paginate($perPage);
        // } else {
        //     return $query->orderBy('description', 'ASC')
        //         ->paginate($perPage);
        // }

        return $query->paginate($perPage);
    }
}