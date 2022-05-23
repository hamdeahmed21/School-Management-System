<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use Illuminate\Http\Request;

class StudentGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MarksGradeView(){
        $allData = StudentGrade::all();
        return view('pages.marks.grade_marks_view',compact('allData'));

    }

    public function MarksGradeAdd(){
        return view('pages.marks.grade_marks_add');
    }

    public function MarksGradeStore(Request $request){

        $data = new StudentGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'message' => 'Grade Marks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('marks.entry.grade')->with($notification);


    } // end Method

    public function MarksGradeEdit($id){
        $editData = StudentGrade::find($id);
        return view('pages.marks.grade_marks_edit',compact('editData'));

    }
    public function MarksGradeUpdate(Request $request, $id){

        $data = StudentGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'message' => 'Grade Marks Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('marks.entry.grade')->with($notification);

    }
}
