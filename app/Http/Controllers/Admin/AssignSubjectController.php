<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AssignSubjects = AssignSubject::with('student_class')->get();
        return view('pages.setup.assign_subject.view_assign_subject',compact('AssignSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = StudentClass::all();
        $school_subject = SchoolSubject::all();
        return view('pages.setup.assign_subject.add_assign_subject',compact('class', 'school_subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subjectCount = count($request->subject_id);
        if ($subjectCount !=NULL) {
            for ($i=0; $i <$subjectCount ; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();

            } // End For Loop
        }// End If Condition

        $notification = array(
            'message' => 'Subject Assign Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assign.subject.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignSubject  $assignSubject
     * @return \Illuminate\Http\Response
     */
    public function show(AssignSubject $assignSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignSubject  $assignSubject
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
        $editData = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        $subjects = SchoolSubject::all();
        $classes = StudentClass::all();
        return view('pages.setup.assign_subject.edit_assign_subject',compact('editData', 'subjects', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignSubject  $assignSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$class_id){
        if ($request->subject_id == NULL) {

            $notification = array(
                'message' => 'Sorry You do not select any Subject',
                'alert-type' => 'error'
            );

            return redirect()->route('assign.subject.edit',$class_id)->with($notification);

        }else{

            $countClass = count($request->subject_id);
            AssignSubject::where('class_id',$class_id)->delete();
            for ($i=0; $i <$countClass ; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();

            } // End For Loop

        }// end Else

        $notification = array(
            'message' => 'Data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('assign.subject.view')->with($notification);
    } // end Method

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignSubject  $assignSubject
     * @return \Illuminate\Http\Response
     */
    public function Details($class_id){
        $data['detailsData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        return view('pages.setup.assign_subject.details_assign_subject',$data);


    }
}