<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_years = StudentYear::all();
        return  view('pages.setup.year.view_year',compact('student_years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('pages.setup.year.add_year');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_year = new StudentYear();
        $class_year->name = $request->name;
        $class_year->save();
        $notification = array(
            'message' => 'student class year Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentYear  $studentYear
     * @return \Illuminate\Http\Response
     */
    public function show(StudentYear $studentYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentYear  $studentYear
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_year = StudentYear::find($id);
        return view('pages.setup.year.edit_year',compact('student_year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentYear  $studentYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $class = StudentYear::find($id);
        $class->name = $request->name;
        $class->save();
        $notification = array(
            'message' => 'student year update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentYear  $studentYear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = StudentYear::find($id)->delete();
        $notification = array(
            'message' => 'student year delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }
}
