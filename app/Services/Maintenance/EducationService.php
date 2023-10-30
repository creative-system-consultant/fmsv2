<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefEducation;

class EducationService
{
    public function isCodeExists($code)
    {
        return RefEducation::whereclientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public function createEducation($description, $code, $status)
    {
        RefEducation::create([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'client_id' => auth()->user()->client_id,
            'status' => $status == true ? '1' : '0',
            'created_at' => now(),
            'created_by' => auth()->user()->name,
        ]);
    }

    public function canUpdateCode($id, $code)
    {
        $existingCode = RefEducation::whereclientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateEducation($id, $description, $code, $status)
    {
        RefEducation::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteEducation($id)
    {
        RefEducation::whereId($id)->delete();
    }

    public function getPaginatedEducation($perPage = 10)
    {
        return RefEducation::whereclientId(auth()->user()->client_id)->paginate($perPage);
    }
}