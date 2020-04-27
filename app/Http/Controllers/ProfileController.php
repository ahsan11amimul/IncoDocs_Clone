<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvitationEmail;
use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Team;

class ProfileController extends Controller
{
    //
    public function profile()
    {   
        if(request()->isMethod('POST'))
        {  
            if(request()->filled('password'))
            {
             $data=request()->validate([
              'name'=>'required',
              'email'=>'required|email',
              'password'=>'required|min:6|max:16|confirmed',
           ]);
           $data['password']=Hash::make($data['password']);
            }else{
                $data=request()->validate([
                  'name'=>'required',
                  'email'=>'required|email',
                ]);
            }
           //dd($data);
           auth()->user()->update($data);
           Auth::logout();
           return \redirect('/login')->with('success','Your Account Has been Updated!!!');
        }else{
            $user=auth()->user();
            return view('pages.profile',compact('user'));
        }
    }
    public function company()
    { 
       if(request()->isMethod('POST'))
       {
           $data=request()->validate([
               'name'=>'required|min:3',
               'registration_number'=>'required|min:3',
               
           ]);
           $company=new Company();
           $company->user_id=Auth::user()->id;
           $company->name=$data['name'];
           $company->registration_number=$data['registration_number'];
           $company->save();
           return redirect('/company')->with('success','Company data saved Successfully');

       }else{
           $company=Company::firstWhere('user_id',Auth::user()->id);
           if(!$company)
           {
               return view("users.create_company");
           }else{
               return view('users.company',compact('company'));
           }
       }
        
    

    }
    public function plans()
    {
       return view('users.plans');
    }
    public function team()
    {
         $users=Team::orderBy('id','DESC')->get();
        return view('users.team',compact('users'));
    }
    public function invitation(Request $request)
    {
        $user=Team::create([
            'email'=>$request->email,
            'user_id'=>Auth::user()->id,
            'role'=>'collaboration'
        ]);
         Notification::send($user,new InvitationEmail($user));
        return response()->json($user);
    }
    public function getteam()
    {
       
    }
}
