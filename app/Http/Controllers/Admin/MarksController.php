<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Marks;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MarksAdd()
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();

        return view('pages.marks.marks_add',compact('years','classes','exam_types'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function MarksStore(Request $request)
    {
        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i <count($request->student_id) ; $i++) {
                $data = New Marks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();

            } // end for loop
        }// end if conditon

        $notification = array(
            'message' => 'Student Marks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// end method

    public function MarksEdit(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();

        return view('pages.marks.marks_edit',compact('years','classes','exam_types'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marks  $marks
     * @return \Illuminate\Http\Response
     */
    public function MarksEditGetStudents(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $getStudent = Marks::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();

        return response()->json($getStudent);

    }
    public function MarksUpdate(Request $request){

        Marks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->delete();

        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i <count($request->student_id) ; $i++) {
                $data = New Marks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();

            } // end for loop
        }// end if conditon

        $notification = array(
            'message' => 'Student Marks Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // end marks
}
