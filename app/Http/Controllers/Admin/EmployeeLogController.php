<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSallaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = User::where('usertype','Employee')->get();
        return view('pages.employee.employee_reg.employee_view',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designation = Designation::all();
        return view('pages.employee.employee_reg.employee_add',compact('designation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            //dd($checkYear);
            $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();

            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if ($employeeId < 10) {
                    $id_no = '000'.$employeeId;
                }elseif ($employeeId < 100) {
                    $id_no = '00'.$employeeId;
                }elseif ($employeeId < 1000) {
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee+1;
                if ($employeeId < 10) {
                    $id_no = '000'.$employeeId;
                }elseif ($employeeId < 100) {
                    $id_no = '00'.$employeeId;
                }elseif ($employeeId < 1000) {
                    $id_no = '0'.$employeeId;
                }

            } // end else

            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $employee_salary = new EmployeeSallaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();


        });


        $notification = array(
            'message' => 'Employee Registration Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);

    } // END Method

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSallaryLog  $employeeSallaryLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = User::find($id);
        $designation = Designation::all();
        return view('pages.employee.employee_reg.employee_edit',compact('editData','designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeSallaryLog  $employeeSallaryLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;

        $user->designation_id = $request->designation_id;
        $user->dob = date('Y-m-d',strtotime($request->dob));


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/employee_images/'.$user->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'),$filename);
            $user['image'] = $filename;
        }
        $user->save();



        $notification = array(
            'message' => 'Employee Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);


    }// END METHOD

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSallaryLog  $employeeSallaryLog
     * @return \Illuminate\Http\Response
     */
    public function Details($id)
    {
        $Details = User::find($id);
        $data = [
            'title' => 'employee_reg',
            'date' => date('m/d/Y')
        ];
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('pages.employee.employee_reg.employee_details_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
