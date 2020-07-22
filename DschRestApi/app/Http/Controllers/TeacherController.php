<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Teacher::all());
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
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'bail|required|date',
            'gender' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'username' => 'bail|required|min:5|unique:App\Teacher',
            'password' => 'bail|required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
                'data' => $request->all()
            ]);
        }

        $data = $request->all();
        $teacher = Teacher::create([
            'first_name' => strtoupper($data['first_name']),
            'last_name' => strtoupper($data['last_name']),
            'birthday' => $data['birthday'],
            'gender' => strtolower($data['gender']),
            'contact' => $data['contact'],
            'email' => $data['email'],
            'address' => $data['address'],
            'qualification' => $data['qualification'],
            'username' => $data['username'],
            'password' => bcrypt($data['password'])
        ]);

        $data['id'] = $teacher->id;

        return response()->json([
            'status' => 1,
            'data' => $data
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
        return response()->json(Teacher::find($id));
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
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'bail|required|date',
            'gender' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'address' => 'required',
            'qualification' => 'required'
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
        $teacher = Teacher::find($id);
        $teacher->delete();

        return response()->json([
            'teacher_id' => $id,
            'status'=> 1
        ]);
    }
}
