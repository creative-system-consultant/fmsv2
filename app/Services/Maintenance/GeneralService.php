<?php

namespace App\Services\Maintenance;

class GeneralService
{
    public static function findById($modelClass, $id)
    {
        return $modelClass::find($id);
    }

    public static function isCodeExists($model, $code)
    {
        return $model::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAll($model)
    {
        return $model::all();
    }

    public static function create($model, $data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        $model::create($mergedData);
    }

    public static function canUpdateCode($model, $id, $code)
    {
        $existingCode = $model::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function update($model, $id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        $model::whereId($id)->update($mergedData);
    }

    public static function delete($model, $id)
    {
        $model::whereId($id)->delete();
    }

    public static function getPaginated($model, $perPage = 10, $searchQuery = '')
    {
        $query = $model::whereClientId(auth()->user()->client_id);

        if ($searchQuery != '') {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('code', 'like', $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            });
        }

        // Assuming every model you use this with has 'priority' and 'description' fields
        // Adjust or remove these if not applicable
        return $query->orderBy('priority', 'ASC')
            ->orderBy('description', 'ASC')
            ->paginate($perPage);
    }
}