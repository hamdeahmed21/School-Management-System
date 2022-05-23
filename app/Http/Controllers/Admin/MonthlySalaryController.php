<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\MonthlySalary;
use Illuminate\Http\Request;
use PDF;
class MonthlySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MonthlySalaryView()
    {
        return view('pages.employee.monthly_salary.monthly_salary_view');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MonthlySalaryGet(Request $request)
    {

        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($allStudent);
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status', 'Absent'));

            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';


            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary / 30;
            $totalsalaryminus = (float)$absentcount * (float)$salaryperday;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>' . $totalsalary . '$' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("employee.monthly.salary.payslip", $attend->employee_id) . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }
        return response()->json(@$html);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function MonthlySalaryPayslip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m', strtotime($id->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();

        $pdf = PDF::loadView('pages.employee.monthly_salary.monthly_salary_pdf', $data);
        return $pdf->stream('document.pdf');

    }
}