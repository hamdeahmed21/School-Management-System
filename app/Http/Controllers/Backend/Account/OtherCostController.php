<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    public function OtherCostView(){
        $AccountOtherCosts = AccountOtherCost::orderBy('id','desc')->get();
        return view('backend.account.other_cost.other_cost_view', compact('AccountOtherCosts'));
    }


    public function OtherCostAdd(){
        return view('backend.account.other_cost.other_cost_add');
    }


    public function OtherCostStore(Request $request){

        $cost = new AccountOtherCost();
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->save();

        $notification = array(
            'message' => 'Other Cost Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('other.cost.view')->with($notification);

    }  // end method


    public function OtherCostEdit($id){
        $editData = AccountOtherCost::find($id);
        return view('backend.account.other_cost.other_cost_edit', compact('editData'));
    }



    public function OtherCostUpdate(Request $request, $id){

        $cost = AccountOtherCost::find($id);
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'.$cost->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->save();

        $notification = array(
            'message' => 'Other Cost Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('other.cost.view')->with($notification);

    } // end method
}
