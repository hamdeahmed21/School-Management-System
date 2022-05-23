<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\Marks;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class ResultReportController extends Controller
{
    public function ResultView(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_type = ExamType::all();
        return view('pages.report.student_result.student_result_view',compact('years','classes','exam_type'));

    }


    public function ResultGet(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $singleResult = Marks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->first();

        if ($singleResult == true) {
            $data['allData'] = Marks::select('year_id','class_id','exam_type_id','student_id')->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
            $pdf = PDF::loadView('pages.report.student_result.student_result_pdf', $data);
            return $pdf->stream('document.pdf');

        }else{
            $notification = array(
                'message' => 'Sorry These Criteria Does not match',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // end Method

}
