<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Company;
use App\Http\Requests\signUpRequest;

class CompanyRegistration extends Controller
{

    public function get_index(){
        return view('users.register');
    }

    public function post_register(signUpRequest $request){
        // $users= new User;
        // $users->name = $request->name;
        // $users->save();

        $company= Company::create([
            'company_name'=>$request->company_name,
            'full_name'=>$request->full_name,
            'company_position'=>$request->company_position,
            'email'=>$request->email,
            'employee_count'=>$request->employee_count,
            'info_source'=>$request->info_source,
            'confirm_code'=>$request->confirm_code
            ]);

        if($company) {

            $company->sendConfirmation([
                'full_name'=>$request->full_name,
                'email'=>$request->email,
                'company_name'=>$request->company_name,
                'confirm_code'=>$request->confirm_code
            ]);

            $success=1;
        }
        else $success=null;




        return redirect('register')->with('success',$success);
        // return redirect()->route('users.test');
    }


    public function get_verification($cc){
        $company=Company::where('confirm_code',$cc)->first();

        if($company){
            $company->update(['confirmed' => 1, 'confirm_code' => 0]);
            $username=strtolower(str_replace(' ','',$company->company_name).'@'.$company->id);
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr( str_shuffle( $chars ), 0, 8);

            $data=array(

            );

            $company->employees()->create([
                'emp_num'           => $company->company_name.'@admin',
                'last_name'         => ' ',
                'first_name'        => $company->full_name,
                'gender'            => 'N/A',
                'email'             => $company->email,
                'contact_num'       => 'N/A',
                'position'          => $company->company_position,
                'employee_type'     => 'N/A',
                'emergency_number'  => 'N/A',
                'system_permission' => 'Account Owner'
            ]);

            $user= new User;
            $user->company()->associate($company);
            $user->employee()->associate($company->employees->first());
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->system_permission = 'Account Owner';
            $user->save();

            $company->sendActivation([
                'username'  => $username,
                'password'  => $password,
                'email'     => $company->email,
                'full_name' => $company->full_name
            ]);

            $verified =1;
        }
        else $verified = 0;

        return redirect('register')->with('verified',$verified);
    }
    //
}
