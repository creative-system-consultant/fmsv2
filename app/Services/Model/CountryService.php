<?php

namespace App\Services\Model;

use App\Models\Ref\RefCountry;

class CountryService
{
    public static function isAbbrExists($abbr)
    {
        return RefCountry::whereClientId(auth()->user()->client_id)->whereAbbr($abbr)->exists();
    }

    public static function getAllCountry()
    {
        return RefCountry::all();
    }

    public static function createCountry($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefCountry::create($mergedData);
    }

    public static function canUpdateAbbr($id, $abbr)
    {
        $existingAbbr = RefCountry::whereClientId(auth()->user()->client_id)->whereAbbr($abbr);
        return !$existingAbbr->exists() || $existingAbbr->value('id') == $id;
    }

    public static function updateCountry($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefCountry::whereId($id)->update($mergedData);
    }

    public static function deleteCountry($id)
    {
        RefCountry::whereId($id)->delete();
    }

    public static function getCountryResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefCountry::whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefCountry::where(function ($query) use ($searchQuery) {
                $query->where('abbr', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}