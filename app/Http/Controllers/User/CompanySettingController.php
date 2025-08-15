<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CompanySettingController extends Controller
{
    public function CompanySetting(){
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->back()->with('error', 'You are not associated with a company');
        }
        return view('client.website.company_setting',compact('company'));

    }
    //End Method
    
    public function CompanySettingUpdate(Request $request){

        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->back()->with('error', 'You are not associated with a company');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'company_logo' => 'nullable'
        ]);

    if ($request->file('company_logo')) {
        $image = $request->file('company_logo');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(867,1000)->save(public_path('upload/slider/'.$name_gen));
        $save_url = 'upload/slider/'.$name_gen;

        if (file_exists(public_path($company->company_logo))) {
           @unlink(public_path($company->company_logo));
        }
        $company->company_logo = $save_url;  
    }


    }
    //End Method




} 
