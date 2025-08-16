<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plan;
use App\Models\Company;
use App\Models\Transaction;
 

class UserController extends Controller
{
    public function UserLogout(Request $request){
        Auth::guard('web')->logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();  

        return redirect('/login');
    }
     //End Method 

      public function UserProfile(){
        $id = Auth::user()->id;
        $proflileData = User::find($id);
        return view('client.client_profile',compact('proflileData'));
     }
     //End Method 


     public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'),$filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                $this->deleteOldImage($oldPhotoPath);
            } 
        }

        $data->save();
        
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
     }
     //End Method 

     private function deleteOldImage(string $oldPhotoPath): void {
        $fullPath = public_path('upload/admin_images/'.$oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
     }
      //End Private Method 

    public function UserChangePassword(){
        return view('client.client_change_password');
    }
    //End Method 


     public function UserPasswordUpdate(Request $request){
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password,$user->password )) {
            
            $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        ); 
        return back()->with($notification); 

        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password) 
        ]);

        Auth::logout();

         $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->route('login')->with($notification); 
    }
      //End Method 

    public function BillingUpgrade(){
        $plans = Plan::all();
        return view('client.backend.plans.upgrade',compact('plans'));
    }
     //End Method 

    public function Tanshir(){
        return view('tanshir.chatbot_test');
    }
    //End Method 
 
    public function CompanyShow(string $slug){
        $company = Company::where('slug',$slug)->first();

        if (!$company) {
           abort(404, 'Company not found or inactive');
        }

        return view('company.company_page',compact('company'));
    }
      //End Method 

    public function SubscribePlan(Request $request, $planId){

        $plan = Plan::findOrFail($planId);
        $user = Auth::user();

        if ($user->plan->name === $plan->name) {

          $notification = array(
            'message' => 'You are already on this plan',
            'alert-type' => 'error'
        ); 
           return redirect()->back()->with($notification); 
        }


        $transaction = Transaction::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'transaction_id' => 'PENDING_' . time(),
            'amount' => $plan->price,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

         $notification = array(
            'message' => 'Please provide your bank transfer details to complete the upgrade',
            'alert-type' => 'warning'
        ); 
           return redirect()->route('plans.payment',$transaction->id)->with($notification);  

    }
     //End Method 

     public function ShowPaymentForm($transactionId){

        $transaction = Transaction::findOrFail($transactionId);
        return view('client.backend.plans.payment',compact('transaction'));

     }
     //End Method 

     public function ProcessPayment(Request $request, $transactionId){

        $request->validate([
            'user_transaction_id' => 'required|string'
        ]);

        $transaction = Transaction::findOrFail($transactionId);

        $transaction->update([
            'transaction_id' => $request->user_transaction_id,
            'status' => 'pending'
        ]);

        $notification = array(
            'message' => 'Your Payment details have been submiited. Plz wait for admin verification',
            'alert-type' => 'warning'
        ); 
           return redirect()->route('billing.upgrade')->with($notification); 

     }
     //End Method 





}
