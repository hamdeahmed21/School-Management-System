<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SchoolSubjects = SchoolSubject::all();
        return view('pages.setup.school_subject.view_school_subject',compact('SchoolSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.setup.school_subject.add_school_subject');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class = new SchoolSubject();
        $class->name = $request->name;
        $class->save();
        $notification = array(
            'message' => 'student SchoolSubject Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolSubject $schoolSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_subject = SchoolSubject::find($id);
        return view('pages.setup.school_subject.edit_school_subject',compact('student_subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $student_subject = SchoolSubject::find($id);
        $student_subject->name = $request->name;
        $student_subject->save();
        $notification = array(
            'message' => 'student SchoolSubject update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_subject = SchoolSubject::find($id);
        $notification = array(
            'message' => 'student SchoolSubject delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }
}
