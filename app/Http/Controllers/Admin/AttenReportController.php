<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class AttenReportController extends Controller
{
    public function AttenReportView(){
        $employees = User::where('usertype','employee')->get();
        return view('pages.report.attend_report.attend_report_view',compact('employees'));
    }


    public function AttenReportGet(Request $request){

        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id',$employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date','like',$date.'%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->get();

        if ($singleAttendance == true) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get();
            // dd($data['allData']->toArray());

            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Absent')->get()->count();

            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Leave')->get()->count();

            $data['month'] = date('m-Y', strtotime($request->date));

            $pdf = PDF::loadView('pages.report.attend_report.attend_report_pdf', $data);
            return $pdf->stream('document.pdf');

        }else{

            $notification = array(
                'message' => 'Sorry These Criteria Donse not match',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


    } // end Method


}
