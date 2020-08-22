<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Classes\SchoolClass;
use App\Settings\AcademicYear;
use App\Students\StudentClass;
use App\Http\Controllers\Controller;

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
        $current = AcademicYear::max('id');
        $values = $request->validate([
            'student_id' => 'required|numeric',
            'class_id' => 'required|numeric'
        ]);

        $class = StudentClass::where('student_id', $values['student_id'])
                            -> where('statut', 1)
                            ->orderBy('id','desc')->get()->first();
              
        if($class==null) $values['repeater'] = false;
        else {
            if($current==$class->academic_year){
                if($class->class_id != $values['class_id']){
                    return response()->json([
                        'status' => 0,
                        'error' => "Student already registered in a different class",
                        'class' => $class->class_id
                    ]);
                }else{
                    return response()->json([
                        'status' => 0,
                        'error' => "Student already registered in this class"
                    ]);
                }
            }else{
                $clas1 = SchoolClass::find($class->class_id);
                $clas2 = SchoolClass::find($values['class_id']);

                if($clas1->main_class != $clas2->main_class){
                    $values['repeater'] = false;
                }else{
                    $values['repeater'] = true;
                }
            }

            $class->statut = 0; 
            $class->save();
        }

        $new_class = StudentClass::create($values);

        return response()->json([
            'status' =>  1,
            'student_class' => $new_class
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
        $new_class = $request->validate([
            'student_id' => 'required|numeric',
            'class_id' => 'required|numeric'
        ]);

        $class = StudentClass::find($id);

        $class->update($new_class);
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
    }
}
