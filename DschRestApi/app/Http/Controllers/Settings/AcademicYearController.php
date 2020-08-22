<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Settings\AcademicYear;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(AcademicYear::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->json(
            AcademicYear::find(AcademicYear::max('id'))
        );
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
        if(date('m')!=7 && date('m')!=8){
            return response()->json([
                'status' => 0,
                'year' => $request->all(),
                'error' => 'New Academic year can only be created either in July or August'
            ]);
        }

        $values = $request->validate([
            'start_date' => 'required|date'
        ]);

        $current = AcademicYear::find(AcademicYear::max('id'));
        $current->end_date = date('Y-m-d');
        $current->ended_by = Auth::user()->id;

        $values['started_by'] = $current->ended_by;

        DB::beginTransaction();
            $current->save();
            $created = AcademicYear::create($values);
        DB::commit();

        return response()->json([
            'status'=> 1,
            'academic_years'=>[
                'old' => $current,
                'new' => $created
            ]
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
        return null;
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
