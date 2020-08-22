<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Students\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $values = $request->validate([
            'admission_number' => 'required|unique:App\Students\Student,admission_number',
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'present',
            'contact' => 'present',
            'father_name' => 'present',
            'father_address' => 'present',
            'father_contact' => 'present',
            'father_mail' => 'present',
            'mother_name' => 'present',
            'mother_address' => 'present',
            'mother_contact' => 'present',
            'mother_mail' => 'present',
            'previous_school' => 'present',
            'faith' => 'present',
            'medical_information' => 'present',
            'picture' => 'present'
        ]);

        if(!$values['father_name'] && !$values['mother_name']){
            return response()->json([
                'status' => 0,
                'errors' => [
                    'fields'=> ['father_name','mother_name'],
                    'comment'=> "At least one of father_name and mother_name must be present."
                ],
                'student' => $values
            ]);
        }

        if($values['father_name']){
            if(!$values['father_address'] || (!$values['father_contact'] && !$values['father_mail'])){
                return response()->json([
                    'status' => 0,
                    'errors' => [
                        'fields'=> ['father_name','father_address','father_contact','father_mail'],
                        'comment'=> "father_address is compulsory when father name is present and should
                                    be given with either father_contact or father_mail"
                    ],
                    'student' => $values
                ]);
            }
        }

        if($values['mother_name']){
            if(!$values['mother_address'] || (!$values['mother_contact'] && !$values['mother_mail'])){
                return response()->json([
                    'status' => 0,
                    'errors' => [
                        'fields'=> ['mother_name','mother_address','mother_contact','mother_mail'],
                        'comment'=> "mother_address is compulsory when mother name is present and should
                                    be given with either mother_contact or mother_mail"
                    ],
                    'student' => $values
                ]);
            }
        }

        $student = Student::create($values);

        return response()->json([
            'status' => 1,
            'student' => $student
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return response()->json(Student::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $values = $request->validate([
            'admission_number' => 'required|unique:App\Students\Student,admission_number',
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'present',
            'contact' => 'present',
            'father_name' => 'present',
            'father_address' => 'present',
            'father_contact' => 'present',
            'father_mail' => 'present',
            'mother_name' => 'present',
            'mother_address' => 'present',
            'mother_contact' => 'present',
            'mother_mail' => 'present',
            'previous_school' => 'present',
            'faith' => 'present',
            'medical_information' => 'present',
            'picture' => 'present'
        ]);

        if(!$values['father_name'] && !$values['mother_name']){
            return response()->json([
                'status' => 0,
                'errors' => [
                    'fields'=> ['father_name','mother_name'],
                    'comment'=> "At least one of father_name and mother_name must be present."
                ],
                'student' => $values
            ]);
        }

        if($values['father_name']){
            if(!$values['father_address'] || (!$values['father_contact'] && !$values['father_mail'])){
                return response()->json([
                    'status' => 0,
                    'errors' => [
                        'fields'=> ['father_name','father_address','father_contact','father_mail'],
                        'comment'=> "father_address is compulsory when father name is present and should
                                    be given with either father_contact or father_mail"
                    ],
                    'student' => $values
                ]);
            }
        }

        if($values['mother_name']){
            if(!$values['mother_address'] || (!$values['mother_contact'] && !$values['mother_mail'])){
                return response()->json([
                    'status' => 0,
                    'errors' => [
                        'fields'=> ['mother_name','mother_address','mother_contact','mother_mail'],
                        'comment'=> "mother_address is compulsory when mother name is present and should
                                    be given with either mother_contact or mother_mail"
                    ],
                    'student' => $values
                ]);
            }
        }

        $student = Student::find($id);
        $student->update($values);
        $student->save();

        return response()->json([
            'status' => 1,
            'student' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
