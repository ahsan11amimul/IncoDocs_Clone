<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteAccepted;
use App\User;

class OnlineController extends Controller
{
    // 
    public function view_quote(Request $request,$key=null)
    {  
        if($key===null)
        {
             return redirect('/')->with('error','Invalid Key');
        }else{
              $quote=Quote::where('key',$key)->first();
              return view('online.quote',compact('quote'));
        }
    }
    public function accept_quote(Quote $quote)
    {
        $quote->update([
            'status'=>'Accepted'
        ]);
        //mail send
        $email=User::where('id',$quote->user_id)->first()->value('email');
        Mail::to($email)->send(new QuoteAccepted($quote));

        return redirect()->back();
    }
     public function unaccept_quote(Quote $quote)
    {
        $quote->update([
            'status'=>'Unaccept'
        ]);
        return redirect()->back();
    }
}
