<?php

namespace App\Students;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    //
    protected $fillable = [
        'academic_year_id', 'student_id', 'class_id', 'repeater'
    ];
}
