<?php

namespace App\Students;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    //
    protected $fillable = ['student_class','type','amount', 'received_by'];
}
