<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


use Illuminate\Http\Request;
use App\User;
use App\ContactUs;
use App\Mail\ContactFormEmail;
use App\Mail\WelcomeEmail;
use App\Events\NewUserHasRegistered;
use App\Notifications\ForgetPassword;
use Illuminate\Support\Str;
use Carbon\Carbon;
class PagesController extends Controller
{
    //
    public function index()
    {
        return view('pages.index');
    }
    public function quotes()
    {
        return view('pages.quotes');
    }
    public function invoices()
    {
        return view('pages.invoices');
    }
    public function pricing()
    {
        return view('pages.pricing');
    }
    public function shipping()
    {
        return view('pages.shipping');
    }
    public function purchase()
    {
        return view('pages.purchase');
    }
    public function trade()
    {
        return view('pages.trade');
    }
    //contact form
    public function contact(Request $request)
    {
        if($request->isMethod("POST"))
        {
            $data=$request->validate([
            'email'=>'required|email',
            'name'=>'required',
            'phone_number'=>'required|digits:11',
            'company_name'=>'required|string',
            'message'=>'required|string'
            ]);
            $contactUs=ContactUs::create($data);
            Mail::to('testing@gmail.com')->send(new ContactFormEmail($data));
            return redirect('/contact')->with('success','Message Sent Successfully!!');

        }else{
            return view('pages.contact');
        }
    }
    //register form
     public function register(Request $request)
    {
        if($request->isMethod("POST"))
        {  
         $data= $request->validate([
          'name'=>'required|min:3|max:50|string',
          'email'=>'required|email',
          'password'=>'string|min:6|max:16'
          ]);
         // dd($data);
          $user=new User();
          //$user->create($data);
          $user->name=$data['name'];
          $user->email=$data['email'];
          $user->password=Hash::make($data['password']);
          $user->email_verification_token=Str::random(40);
          $user->save();
          event(new NewUserHasRegistered($user));
          //Mail::to($user->email)->send(new WelcomeEmail($user));
          //return \redirect('/login');
          return redirect('/login')->with('success','Registration success we have send an email please verify it!!');

        }else{
            return view('pages.register');
        }
    }
     public function verifyEmail(Request $request,$token=null)
   {
    if($token===null)
    {
          return \redirect('/login')->with('error','Invalid token');
    }
    $user=User::where('email_verification_token',$token)->first();
     if($user===null)
     {
          return \redirect('/login')->with('error','Invalid token');
     }

     DB::table('users')->where('email_verification_token',$token)
     ->update(['email_verified'=>1,'email_verification_token'=>'','email_verified_at'=>Carbon::now()->toDateTimeString()]);
     return \redirect('/login')->with('success','Your Account has been Activated Login now!!!');
   }
    //login form
     public function login(Request $request)
    {
        if($request->isMethod("POST"))
        {
             $data=$request->validate([
                'email'=>'required|email',
                'password'=>'required|min:6'
            ]);
            $email=$data['email'];
            $password=$data['password'];
             if(Auth::attempt(['email'=>$email,'password'=>$password,'email_verified'=>1]))
             {    
                 $status=Auth::user();
              
                 if($status->is_admin==1)
                 {
                    return redirect('/admin/dashboard');
                 }else{
                   return redirect('/user/dashboard');
                 }
             
               
             }
             else
             {
             return \redirect('/login')->with('error','Invalid credentials or activate your account');
             }

        }else{
            return view('pages.login');
        }
    }
    //Forget password 
    public function forgetpassword(Request $request)
    {
       if($request->isMethod('POST'))
    {
        $data=$request->validate([
        'email'=>'required|email|string',
        ]);
        $user=User::where('email',$data['email'])->first();
        if(!$user)
        {
            return redirect('/forgetpassword')->with('error','You are not a registered User!!');
        }
        //  Mail::to($user->email)->send(new ForgetPassword($user));
         Notification::send($user,new ForgetPassword($user));
       //$users->notify(new newOrder($order));
         return redirect('/login')->with('success','Please check your Email!!!');

    }
      else{
           return view('pages.forget_password');
      }

    }
public function createpassword(Request $request,$id)
   {  
    
    if($request->isMethod('POST'))
    {
        $data=$request->validate([
        'password'=>'required|min:8',
        'confirm_password'=>'required|min:8',
      
        ]);
        $user_check=User::where('id',$id)->first();
        if(!$user_check)
        {
             return \redirect()->back()->with('error','Invalid route!');
        }
        if($data['password']!=$data['confirm_password'])
        {
          return \redirect()->back()->with('error','Password Does not Match!');
        }
      DB::table('users')->where('id',$id)->update([
          'password'=>bcrypt($data['password'])]);
          return redirect('/login')->with('success','Password Updated!!!');

    }
      else{
           $user=User::where('id',$id)->first();
           return view('pages.create_password',compact('user'));
      }
   }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
