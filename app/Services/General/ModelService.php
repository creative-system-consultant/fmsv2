<?php

namespace App\Services\General;

class ModelService
{
    public static function findById($modelClass, $id)
    {
        return $modelClass::find($id);
    }

    public static function findFirstByClientId($modelClass, $id)
    {
        return $modelClass::whereClientId($id)->first();
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

    public static function update($model, $id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        $model::whereId($id)
            ->where('client_id', auth()->user()->client_id)
            ->update($mergedData);
    }

    public static function updateUsingClientId($model, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        $model::where('client_id', auth()->user()->client_id)
            ->update($mergedData);
    }

    public static function delete($model, $id)
    {
        $model::whereId($id)->delete();
    }
}