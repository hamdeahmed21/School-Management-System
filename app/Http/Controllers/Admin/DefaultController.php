<?php

namespace App\Http\Controllers\Admin;
use App\Models\AssignSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function GetSubject(Request $request){
        $class_id = $request->class_id;
        $allData = AssignSubject::with(['school_subject'])->where('class_id',$class_id)->get();
        return response()->json($allData);

    }


    public function GetStudents(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = AssignSubject::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        return response()->json($allData);

    }
}
