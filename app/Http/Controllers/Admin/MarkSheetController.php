<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Marks;
use App\Models\StudentClass;
use App\Models\StudentGrade;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarkSheetController extends Controller
{
    public function MarkSheetView(){

        $years = StudentYear::orderBy('id','desc')->get();
        $classes = StudentClass::all();
        $exam_type = ExamType::all();
        return view('pages.report.marksheet.marksheet_view',compact('years','classes','exam_type'));

    }


    public function MarkSheetGet(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = Marks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();
        // dd($count_fail);
        $singleStudent = Marks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->first();
        if ($singleStudent == true) {

            $allMarks = Marks::with(['assign_subject','year'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
            // dd($allMarks->toArray());
            $allGrades = StudentGrade::all();
            return view('pages.report.marksheet.marksheet_pdf',compact('allMarks','allGrades','count_fail'));

        }else{

            $notification = array(
                'message' => 'Sorry These Criteria Donse not match',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


    } // end Method



}
