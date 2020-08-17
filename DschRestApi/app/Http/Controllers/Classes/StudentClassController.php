<?php

namespace App\Http\Controllers\Classes;

use App\Classes\StudentClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(StudentClass::all());
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
        $values= $request->validate([
            'main_class' => 'required',
            'class_name' => 'required',
            'optional_subjects' => 'present'
        ]);

        if($values['optional_subjects']==1)
            $values['optional_subjects'] = true;
        else
            $values['optional_subjects'] = false;
        
        $class = StudentClass::create($values);
        
        return response()->json([
            'status' => 1,
            'student_class' => $class
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
        return response()->json(StudentClass::find($id));
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
        $class = StudentClass::find($id);
        $values= $request->validate([
            'main_class' => 'required',
            'class_name' => 'required',
            'optional_subjects' => 'present'
        ]);

        if($values['optional_subjects']==1)
            $values['optional_subjects'] = true;
        else
            $values['optional_subjects'] = false;
        
        $class->update($values);
        $class->save();
        
        return response()->json([
            'status' => 1,
            'student_class' => $class
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
        $class = StudentClass::find($id);
        $class->delete();

        $class->save();
    }
}
