<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSallary;
use App\Models\EmployeeSallaryLog;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSallaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = User::where('usertype','employee')->get();
        return view('pages.employee.employee_salary.employee_salary_view',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSallaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d',strtotime($request->effected_salary));
        $salaryData->save();

        $notification = array(
            'message' => 'Employee Salary Increment Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.salary.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeSallary  $employeeSallary
     * @return \Illuminate\Http\Response
     */
    public function Increment($id)
    {
        $editData = User::find($id);
        return view('pages.employee.employee_salary.employee_salary_increment',compact('editData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSallary  $employeeSallary
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSallary $employeeSallary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeSallary  $employeeSallary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSallary $employeeSallary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSallary  $employeeSallary
     * @return \Illuminate\Http\Response
     */
    public function Details($id)
    {
        $details = User::find($id);
        $salary_log = EmployeeSallaryLog::where('employee_id',$details->id)->get();
        return view('pages.employee.employee_salary.employee_salary_details',compact('details','salary_log'));
    }
}
