<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['title','coefficient','compulsory','student_class_id'];
}
