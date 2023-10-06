<?php

namespace App\Services\Maintenance;

use App\Models\Ref\RefBank;

class BankService
{
    public function isCodeExists($code)
    {
        return RefBank::whereCoopId(auth()->user()->coop_id)->whereCode($code)->exists();
    }

    public function createBank($description, $code, $status)
    {
        RefBank::create([
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
        $existingCode = RefBank::whereCoopId(auth()->user()->coop_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateBank($id, $description, $code, $status)
    {
        RefBank::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteBank($id)
    {
        RefBank::whereId($id)->delete();
    }

    public function getPaginatedBank($perPage = 10)
    {
        return RefBank::whereCoopId(auth()->user()->coop_id)->paginate($perPage);
    }
}