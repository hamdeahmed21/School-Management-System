<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_shift = StudentShift::all();
        return view('pages.setup.shift.view_shift',compact('student_shift'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.setup.shift.add_shift');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class_group = new StudentShift();
        $class_group->name = $request->name;
        $class_group->save();
        $notification = array(
            'message' => 'student Shift Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentShift  $studentShift
     * @return \Illuminate\Http\Response
     */
    public function show(StudentShift $studentShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentShift  $studentShift
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_shift = StudentShift::find($id);
        return  view('pages.setup.shift.edit_shift',compact('student_shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentShift  $studentShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $shift = StudentShift::find($id);
        $shift->name = $request->name;
        $shift->save();
        $notification = array(
            'message' => 'student Shift update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentShift  $studentShift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = StudentShift::find($id)->delete();
        $notification = array(
            'message' => 'student shift delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    }
}
