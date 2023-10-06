<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefTitle;

class TitleService
{
    public function isCodeExists($code)
    {
        return RefTitle::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createTitle($description, $code, $status)
    {
        RefTitle::create([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'coop_id' => auth()->user()->coop_id,
            'status' => $status == true ? '1' : '0',
            'created_at' => now(),
            'created_by' => auth()->user()->name,
        ]);
    }

    public function canUpdateCode($id, $code)
    {
        $existingCode = RefTitle::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateTitle($id, $description, $code, $status)
    {
        RefTitle::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteTitle($id)
    {
        RefTitle::whereId($id)->delete();
    }

    public function getPaginatedTitle($perPage = 10)
    {
        return RefTitle::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}