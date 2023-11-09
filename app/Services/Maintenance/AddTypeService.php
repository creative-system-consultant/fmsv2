<?php

namespace App\Services\Maintenance;

use App\Models\Ref\AddressType;

class AddTypeService
{
    public static function isCodeExists($code)
    {
        return AddressType::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllAddType()
    {
        return AddressType::all();
    }

    public static function createAddType($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        AddressType::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = AddressType::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public static function updateAddType($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        AddressType::whereId($id)->update($mergedData);
    }

    public static function deleteAddType($id)
    {
        AddressType::whereId($id)->delete();
    }

    public static function getPaginatedAddTypes($perPage = 10)
    {
        return AddressType::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}