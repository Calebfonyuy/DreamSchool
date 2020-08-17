<?php

namespace App\Students;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['admission_number','first_name','last_name','date_of_birth',
                'gender','address','email','contact'];
    /**
     * Other attributes include
     * father_name, father_address, father_contact, father_mail,
     * mother_name, mother_address, mother_contact, mother_mail,
     * previous_school, faith, medical_information, picture
     */
}
