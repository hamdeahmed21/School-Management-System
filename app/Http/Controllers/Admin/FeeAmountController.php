<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FeeAmounts = FeeAmount::with('fee_cateogry')->get();
        return view('pages.setup.fee_amount.view_fee_amount',compact('FeeAmounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = StudentClass::all();
        $feecategory = FeeCategory::all();
        return view('pages.setup.fee_amount.add_fee_amount',compact('class','feecategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $countClass = count($request->class_id);
        if ($countClass !=NULL) {
            for ($i=0; $i <$countClass ; $i++) {
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            } // End For Loop
        }// End If Condition

        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);

    }  // End Method

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeeAmount  $feeAmount
     * @return \Illuminate\Http\Response
     */
    public function show(FeeAmount $feeAmount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeAmount  $feeAmount
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_category_id)
    {
        $data['editData'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('pages.setup.fee_amount.edit_fee_amount',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeeAmount  $feeAmount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$fee_category_id){
        if ($request->class_id == NULL) {

            $notification = array(
                'message' => 'Sorry You do not select any class amount',
                'alert-type' => 'error'
            );

            return redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);

        }else{

            $countClass = count($request->class_id);
            FeeAmount::where('fee_category_id',$fee_category_id)->delete();
            for ($i=0; $i <$countClass ; $i++) {
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            } // End For Loop

        }// end Else

        $notification = array(
            'message' => 'Data Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);
    } // end Method

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeAmount  $feeAmount
     * @return \Illuminate\Http\Response
     */
    public function Details($fee_category_id){
        $data['detailsData'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();

        return view('pages.setup.fee_amount.details_fee_amount',$data);


    }
}
