<?php

namespace App\Services\Maintenance;

class GeneralService
{
    public static function isCodeExists($model, $code, $column = 'code')
    {
        return $model::whereClientId(auth()->user()->client_id)->where($column , $code)->exists();
    }

    public static function canUpdateCode($model, $id, $code, $column = 'code')
    {
        $existingCode = $model::whereClientId(auth()->user()->client_id)->where($column, $code);

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
        }

        return $query->paginate($perPage);
    }
}