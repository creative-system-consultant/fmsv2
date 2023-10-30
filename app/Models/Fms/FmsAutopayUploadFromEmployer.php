<?php

namespace App\Models\FMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAutopayUploadFromEmployer extends Model
{
    use HasFactory;

    protected $table   = 'FMS.AUTOPAY_UPLOAD_FROM_EMPLOYER';
    protected $guarded = [];
}
