<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\ClassFee;
use Illuminate\Support\Facades\Auth;

class ClassFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $values = request()->validate([
            'academic_year' => 'required|numeric'
        ]);

        $fees = ClassFee::where('academic_year', $values['academic_year'])
                        ->where('statut',1)->get();

        return response()->json($fees);
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
            'fee_amount' => 'required|numeric|min:1',
            'registration' => 'required|numeric|min:1',
            'pta_levy' => 'required|numeric|min:1',
            'class_id' => 'required|numeric|min:1',
            'academic_year' => 'required|numeric|min:1'
        ]);

        $values['saved_by'] = Auth::user()->id;

        $fee = ClassFee::create($values);

        return response()->json([
            'statut' => 1,
            'fee' => $fee
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
        $fee = ClassFee::find($id);
        if($fee==null){
            return response()->json([
                'statut' => 0,
                'error' => 'Invalid Fee reference'
            ]);
        }

        $values = $request->validate([
            'fee_amount' => 'required|numeric|min:1',
            'registration' => 'required|numeric|min:1',
            'pta_levy' => 'required|numeric|min:1',
            'class_id' => 'required|numeric|min:1',
            'academic_year' => 'required|numeric|min:1'
        ]);

        if($fee->student_class!=$values['student_class'] ||$fee->academic_year!=$values['academic_year'] ){
            return response()->json([
                'statut' => 0,
                'error' => 'Class or Year information invalid for given reference',
                'fee_values' => $values
            ]);
        }

        if($fee->statut==0){
            return response()->json([
                'statut' => 0,
                'error' => "Cannot update deleted fee reference",
                'reference' => $id
            ]);
        }

        $fee->amount = $values['amount'];
        $fee->saved_by = Auth::user()->id;
        $fee->save();

        return response()->json([
            'statut' => 1,
            'fee' => $fee
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
