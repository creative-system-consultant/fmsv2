<?php

namespace App\Services\Model;

use App\Models\Ref\RefState;

class StateService
{
    public function isCodeExists($code)
    {
        return RefState::whereClientId(auth()->user()->client_id)->whereCode($code)->exists();
    }

    public function createState($description, $code, $status)
    {
        RefState::create([
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
        $existingCode = RefState::whereClientId(auth()->user()->client_id)->whereCode($code);

        return !$existingCode->exists() || $existingCode->value('id') == $id;
    }

    public function updateState($id, $description, $code, $status)
    {
        RefState::whereId($id)->update([
            'description' => trim(strtoupper($description)),
            'code' => trim(strtoupper($code)),
            'status' => $status == true ? '1' : '0',
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ]);
    }

    public function deleteState($id)
    {
        RefState::whereId($id)->delete();
    }

    public function getPaginatedState($perPage = 10)
    {
        return RefState::whereClientId(auth()->user()->client_id)->paginate($perPage);
    }
}