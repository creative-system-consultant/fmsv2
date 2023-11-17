<?php

namespace App\Services\Model;

use App\Models\Ref\RefJobStatus;

class JobStatusService
{
    public static function isCodeExists($code)
    {
        return RefJobStatus::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public static function getAllJobStatusService()
    {
        return RefJobStatus::all();
    }

    public static function createJobStatus($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $mergedData = array_merge($data, $defaultData);
        RefJobStatus::create($mergedData);
    }

    public static function canUpdateCode($id, $code)
    {
        $existingCode = RefJobStatus::whereClientId(auth()->user()->client_id)->whereCode($code);
        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }
    public static function updateJobStatus($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->id()
        ];

        $mergedData = array_merge($data, $defaultData);
        RefJobStatus::whereId($id)->update($mergedData);
    }

    public static function deleteJobStatus($id)
    {
        RefJobStatus::whereId($id)->delete();
    }

    public static function getJobStatusResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return RefJobStatus::whereClientId(auth()->user()->client_id)->paginate($perPage);
        }
        else
        {
            return RefJobStatus::whereClientId(auth()->user()->client_id)->where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->paginate($perPage);
        }
    }
}