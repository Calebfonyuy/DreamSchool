<?php

namespace App\Http\Controllers\Classes;

use App\Classes\StudentClass;
use App\Classes\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Subject::all());
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
            'title' => 'required',
            'coefficient' => 'required',
            'compulsory' => 'present',
            'student_class_id' => 'required|numeric'
        ]);

        $class = StudentClass::find($values['student_class_id']);
        if(!$class->optional_subjects){
            return response()->json([
                'status' => 0,
                'message' => "A class with no optional subjects cannot have a subject that is not compulsory",
                'subject' => $values
            ]);
        }

        $subject = Subject::create($values);

        return response()->json([
            'statut' => 1,
            'subject' => $subject
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
        return response()->json(Subject::find($id));
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
            'title' => 'required',
            'coefficient' => 'required',
            'compulsory' => 'present',
            'student_class_id' => 'required|numeric'
        ]);

        $class = StudentClass::find($values['student_class_id']);
        if(!$class->optional_subjects){
            return response()->json([
                'status' => 0,
                'message' => "A class with no optional subjects cannot have a subject that is not compulsory",
                'subject' => $values
            ]);
        }

        $subject = Subject::find($id);
        $subject->update($values);
        $subject->save();

        return response()->json([
            'statut' => 1,
            'subject' => $subject
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
        $subject = Subject::find($id);
        $subject->delete();

        return response()->json($subject);
    }
}
