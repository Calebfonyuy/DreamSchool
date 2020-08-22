<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    //
    protected $fillable =['start_date','started_by'];
    protected $hidden = ['id'];
}
