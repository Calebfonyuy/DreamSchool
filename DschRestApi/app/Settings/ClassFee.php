<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Model;

class ClassFee extends Model
{
    //
    protected $fillable=['fee_amount','registration','pta_levy','class_id','academic_year'];
}
