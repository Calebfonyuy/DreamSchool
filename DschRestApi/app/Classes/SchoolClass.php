<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['main_class','class_name','optional_subjects'];

}
