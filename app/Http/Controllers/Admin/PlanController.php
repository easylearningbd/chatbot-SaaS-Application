<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plan;

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



}
