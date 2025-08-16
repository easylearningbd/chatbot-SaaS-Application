<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plan;
use App\Models\Transaction;

class PlanController extends Controller
{
    public function AllPlans(){
        $plan = Plan::latest()->get();
        return view('admin.backend.plan.all_plan',compact('plan'));
    }
    //End Method 

    public function AddPlans(){
     return view('admin.backend.plan.add_plan');
    }
     //End Method 

    public function StorePlans(Request $request){

        Plan::create([
            'name' => $request->name,
            'knowledge_base' => $request->knowledge_base,
            'chat_bot' => $request->chat_bot,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Plan Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plans')->with($notification); 

    }
     //End Method 

     public function EditPlans($id){
        $plan = Plan::find($id);
        return view('admin.backend.plan.edit_plan',compact('plan'));
     }
     //End Method 

     public function UpdatePlans(Request $request){
        $plan_id = $request->id;

        Plan::find($plan_id)->update([
            'name' => $request->name,
            'knowledge_base' => $request->knowledge_base,
            'chat_bot' => $request->chat_bot,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Plan Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plans')->with($notification); 

    }
     //End Method 

    public function DeletePlans($id){

        Plan::find($id)->delete();

        $notification = array(
            'message' => 'Plan Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }
    //End Method 

    public function AllOrders(){
        $orders = Transaction::with(['user','plan'])->get();
        return view('admin.backend.transaction.all_transaction',compact('orders'));

    }
    //End Method 

    public function UpdateTransaction(Request $request, $id){
        $transaction = Transaction::findOrFail($id);
        $newStatus = $request->input('status');

        $transaction->status = $newStatus;
        $transaction->save();

        if ($newStatus === 'approved') {
            $user = $transaction->user;
            $user->plan_id = $transaction->plan_id; // Update user plan_id to the new plan
            $user->save();
        }

        $notification = array(
            'message' => 'Transaction Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.orders')->with($notification);  

    }
      //End Method 



}
