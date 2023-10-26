<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMiscAccount extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table   = 'FMS.MISC_ACCOUNT';
    protected $guarded = [];

    // Relationship
    public function fmsMembership()
    {
        return $this->belongsTo(FmsMembership::class, 'mbr_no', 'mbr_no');
    }
}