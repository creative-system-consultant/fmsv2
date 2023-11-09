<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefLanguage;

class LanguageService
{
    public static function isInstituteIdExists($institute_id)
    {
        return RefLanguage::whereClientId(auth()->user()->client_id)->whereInstituteId($institute_id)->exists();
    }

    public static function getAllLanguage()
    {
        return RefLanguage::all();
    }

    public static function createLanguage($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        RefLanguage::create($mergedData);
    }

    public static function canUpdateInstituteId($id, $institute_id)
    {
        $existingInstituteId = RefLanguage::whereClientId(auth()->user()->client_id)->whereInstituteId($institute_id);

        return !$existingInstituteId->exists() || $existingInstituteId->value('id') == $id;
    }

    public static function updateLanguage($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);

        RefLanguage::whereId($id)->update($mergedData);
    }

    public static function deleteLanguage($id)
    {
        RefLanguage::whereId($id)->delete();
    }

    public static function getPaginatedLanguages($perPage = 10)
    {
        return RefLanguage::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}