<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendQuote;   
use Illuminate\Support\Str;
use App\Quote;
use App\OrderItem;   
use DataTables;
use App\Contact;
use PDF;


class QuoteController extends Controller  
{
   public function index()  
    {
          if(request()->ajax())
        {
            return DataTables()->of(Quote::where('user_id',auth()->user()->id)->latest()->get())
                    ->addColumn('action', function($data){
                        // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        // $button .= '&nbsp;&nbsp;';
                        // $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        // return $button;
                        $dropdown  ='<div class="dropdown">';
                        $dropdown .='<button class="btn btn-primary dropdown-toggle" type="button"id="option"data-toggle="dropdown"><i class="fas fa-braille"></i></button>';
                        $dropdown .='<div class="dropdown-menu dropdown-menu-right" aria-labelledby="option">';
                        $dropdown .='<a class="dropdown-item text-muted" href="/quotes/'.$data->id.'/edit"><i class="fas fa-pen mr-3"></i>Edit Document</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/quotes/'.$data->id.'/show"><i class="fas fa-eye mr-3"></i>View</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted email" href="#" id="'.$data->id.'"data-toggle="modal" data-target="#emailModal"><i class="fas fa-paper-plane mr-3"></i>Send</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/quotes/'.$data->id.'/print"> <i class="fas fa-print mr-3"></i>Print</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/quotes/'.$data->id.'/download"> <i class="fas fa-download mr-3"></i>Download</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item delete" href="#" id="'.$data->id.'"> <i class="fas fa-trash text-danger mr-3"></i>Delete</a>';
                        $dropdown .='</div>';
                        $dropdown .='</div>';
                        return $dropdown;
                    })
                    ->editColumn('status',function($user){
                        // if($user->status=='Draft')
                        // {
                        //    return '<button type="button" class="btn btn-info btn-sm">'.$user->status.'</button>';
                        // }else if($user->status=='Sent')
                        // {
                        //  return '<button type="button" class="btn btn-info btn-sm">'.$user->status.'</button>';
                        // }else if($user->status=='Accepted')
                        // {
                        //  return '<button type="button" class="btn btn-info btn-sm">'.$user->status.'</button>';
                        // }else{
                        //  return '<button type="button" class="btn btn-info btn-sm">'.$user->status.'</button>';
                        // }
                        return $user->status;
                    
                    })
                    ->editColumn('created_at', function ($user) 
                        {
                            //change over here
                            return date('d-M-Y', strtotime($user->created_at) );
                        })
                    ->editColumn('buyer',function($user){
                        $buyer_id=$user->buyer_id;
                        $buyer=Contact::where('id',$buyer_id)->value('first_name');
                        return $buyer;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.quotes.index');
    }
    public function show(Quote $quote)
    {
        return view('users.quotes.show',compact('quote'));
    }
    public function create()
    {
        return view('users.quotes.create');
    }
    public function store(Request $request)
    {
        //dd($request->all());
         //dd($request->all());
        $request->validate([
            'quote_number'=>'required|string|unique:quotes,quote_number'
        ]);
         $quote=new Quote();
         $quote->user_id=auth()->user()->id;
         $quote->quote_number=$request->quote_number;
         $quote->seller_id=$request->seller_id;
         $quote->buyer_id=$request->buyer_id;
         $quote->date=$request->date;
         $quote->key=Str::random(40);
         $quote->buyer_reference=$request->buyer_reference;
         $quote->delivery_date=$request->delivery_date;
         $quote->dispatch_id=$request->dispatch_id;
         $quote->shipment_type=$request->shipment_type;  
         $quote->loading_id=$request->loading_id;
         $quote->discharge_id=$request->discharge_id;
         $quote->payment_method=$request->payment_method;
         $quote->additional_info=$request->additional_info;
        
         $quote->discount=$request->discount;
         $quote->invoice_total=$request->invoice_total;
         $quote->bank_detail=$request->bank_detail;
         $quote->place=$request->place;
         $quote->action_date=$request->action_date;
         $quote->signatory_company=$request->signatory_company;
         $quote->first_name=$request->first_name;
         $quote->last_name=$request->last_name;
         if($request->hasFile('signature'))
         {
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $quote->signature=$imagePath;
         }
         //image resize
         
         $quote->save();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->quote_number,
                'code'          =>$request->code[$i],
                'description'   =>$request->description[$i],
                'quantity'      =>$request->quantity[$i], 
                'unit'          =>$request->unit[$i],
                'price'         =>$request->price[$i],
                'amount'        =>$request->amount[$i]
            );
                $insert_data[]=$data;
        }
        OrderItem::insert($insert_data);
        return redirect('/quotes')->with('success','Quote Saved as draft');
    }
    public function edit(Quote $quote)
    {
        return view('users.quotes.edit',compact('quote'));
    }
     public function update(Request $request,Quote $quote)
    {
        //dd($request->all());
         //dd($request->all());
       
         $quote->user_id=auth()->user()->id;
         $quote->quote_number=$request->quote_number;
         $quote->seller_id=$request->seller_id;
         $quote->buyer_id=$request->buyer_id;
         $quote->date=$request->date;
         $quote->buyer_reference=$request->buyer_reference;
         $quote->delivery_date=$request->delivery_date;
         $quote->dispatch_id=$request->dispatch_id;
         $quote->shipment_type=$request->shipment_type;  
         $quote->loading_id=$request->loading_id;
         $quote->discharge_id=$request->discharge_id;
         $quote->payment_method=$request->payment_method;
         $quote->additional_info=$request->additional_info;
        
         $quote->discount=$request->discount;
         $quote->invoice_total=$request->invoice_total;
         $quote->bank_detail=$request->bank_detail;
         $quote->place=$request->place;
         $quote->action_date=$request->action_date;
         $quote->signatory_company=$request->signatory_company;
         $quote->first_name=$request->first_name;
         $quote->last_name=$request->last_name;
         if($request->hasFile('signature'))
         {
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $quote->signature=$imagePath;
         }else{
             $imagePath=$request->old_image;
             $quote->signature=$imagePath;
         }
         $quote->save();
         OrderItem::where('invoice_number',$request->quote_number)->delete();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->quote_number,
                'code'          =>$request->code[$i],
                'description'   =>$request->description[$i],
                'quantity'      =>$request->quantity[$i], 
                'unit'          =>$request->unit[$i],
                'price'         =>$request->price[$i],
                'amount'        =>$request->amount[$i]
            );
                $insert_data[]=$data;
        }
        OrderItem::insert($insert_data);
        return redirect('/quotes')->with('success','Saved Changes Successfully');
    }
    public function destroy(Quote $quote)
    {  
        //dd($quote);
        $quote->delete();
    }
    public function getInfo($id)
    {
        $data=Quote::findOrFail($id);
        $seller_email=Contact::where('id',$data->seller_id)->first()->value('email');
        return response()->json(['data'=>$data,'email'=>$seller_email]);
    }
    public function sendQuote(Request $request)
    {
        $quote_number=$request->quote_number;
        $email=$request->email;
        $quote=Quote::where('quote_number',$quote_number)->first();
        if($quote)
        {   
            Mail::to($email)->send(new SendQuote($quote,$email));
            $quote->update([
                'status'=>'Sent'
            ]);
          return response()->json(['data'=>'Success']);
        }else{
            return response()->json(['data'=>'Error']);
        }
        
    }
     //download
    public function downloadPdf(Quote $quote)
    {
        //dd($invoice);
        $pdf=PDF::loadView('users.quotes.pdf',compact('quote'));
        //dd($pdf);
        return $pdf->download('quote.pdf');

    }
      //Print
    public function printPdf(Quote $quote)
    {
        //dd($invoice);
        $pdf=PDF::loadView('users.quotes.pdf',compact('quote'));
        //dd($pdf);
        return $pdf->stream('quote.pdf');

    }
}
