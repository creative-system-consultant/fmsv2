<?php

namespace App\Services\Model;

use App\Models\Ref\RefTitle;

class TitleService
{
    public static function isTitleIdExists($title_id)
    {
        return RefTitle::whereClientId(auth()->user()->client_id)->wheretitle_id($title_id)->exists();
    }

    public static function getAllTitle()
    {
        return RefTitle::all();
    }

    public static function createTitle($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefTitle::create($mergedData);
    }

    public static function canUpdateTitleId($id, $title_id)
    {
        $existingTitleId = RefTitle::whereClientId(auth()->user()->client_id)->whereTitleId($title_id);
        return !$existingTitleId->exists() || $existingTitleId->value('id') == $id;
    }

    public static function updateTitle($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefTitle::whereId($id)->update($mergedData);
    }

    public static function deleteTitle($id)
    {
        RefTitle::whereId($id)->delete();
    }
    
    public static function getTitleResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefTitle::whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
        else
        {
            return RefTitle::where(function ($query) use ($searchQuery) {
                $query->where('title_id', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('description','ASC')
            ->paginate($perPage);
        }
    }
}