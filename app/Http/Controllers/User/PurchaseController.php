<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\OrderItem;   
use App\Contact;
use DataTables;
use App\Purchase;

class PurchaseController extends Controller
{
    //
     public function index()  
    {
          if(request()->ajax())
        {
            return DataTables()->of(Purchase::where('user_id',auth()->user()->id)->latest()->get())
                    ->addColumn('action', function($data){
                        // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        // $button .= '&nbsp;&nbsp;';
                        // $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        // return $button;
                        $dropdown  ='<div class="dropdown">';
                        $dropdown .='<button class="btn btn-primary dropdown-toggle" type="button"id="option"data-toggle="dropdown"><i class="fas fa-braille"></i></button>';
                        $dropdown .='<div class="dropdown-menu dropdown-menu-right" aria-labelledby="option">';
                        $dropdown .='<a class="dropdown-item text-muted" href="/purchases/'.$data->id.'/edit"><i class="fas fa-pen mr-3"></i>Edit Document</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/purchases/'.$data->id.'/show"><i class="fas fa-eye mr-3"></i>View</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted email" href="#" id="'.$data->id.'"data-toggle="modal" data-target="#emailModal"><i class="fas fa-paper-plane mr-3"></i>Send</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/purchases/'.$data->id.'/print"> <i class="fas fa-print mr-3"></i>Print</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/purchases/'.$data->id.'/download"> <i class="fas fa-download mr-3"></i>Download</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item delete" href="#" id="'.$data->id.'"> <i class="fas fa-trash text-danger mr-3"></i>Delete</a>';
                        $dropdown .='</div>';
                        $dropdown .='</div>'; 
                        return $dropdown;
                    })
                   // ->editColumn('status',function($user){

                        //$button='<button type="button" class="btn btn-priamry btn-sm">Draft</button>';
                        // if($user->state=='Draft')
                        //  {
                        //     return '<button type="button" class="btn btn-info btn-sm">'.$user->state.'</button>';
                        //  }else if($user->state=='Sent')
                        //  {
                        //   return '<button type="button" class="btn btn-warning btn-sm">'.$user->state.'</button>';
                        //  }else if($user->state=='Accepted')
                        // {
                        //   return '<button type="button" class="btn btn-success btn-sm">'.$user->state.'</button>';
                        // }else{
                        //   return '<button type="button" class="btn btn-danger btn-sm">'.$user->state.'</button>';
                        // }
                       // return $button;
                      // })
                    ->editColumn('created_at', function ($user) 
                        {
                            //change over here
                            return date('d-M-Y', strtotime($user->created_at) );
                        })
                    ->editColumn('seller',function($user){
                        $seller_id=$user->seller_id;
                        $seller=Contact::where('id',$seller_id)->value('first_name');
                        return $seller;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.purchases.index')->with('success','Purchase order hasbeen drafted!!!');
    }
     public function show(Purchase $purchase)
    {
        return view('users.purchases.show',compact('purchase'));
    }
    public function create()
    {
        return view('users.purchases.create');
    }
    public function store(Request $request)
    {
       // dd($request->all());
        
        $request->validate([
            'purchase_number'=>'required|string|unique:purchases,purchase_number'
        ]);
         $purchase=new Purchase();
         $purchase->user_id=auth()->user()->id;
         $purchase->purchase_number=$request->purchase_number;
         $purchase->seller_id=$request->seller_id;
         $purchase->buyer_id=$request->buyer_id;
         $purchase->date=$request->date;
         $purchase->key=Str::random(40);
         $purchase->buyer_reference=$request->buyer_reference;
         $purchase->delivery_date=$request->delivery_date;
         $purchase->dispatch_id=$request->dispatch_id;
         $purchase->shipment_type=$request->shipment_type;  
         $purchase->loading_id=$request->loading_id;
         $purchase->discharge_id=$request->discharge_id;
         $purchase->payment_method=$request->payment_method;
         $purchase->additional_info=$request->additional_info;
        
         $purchase->discount=$request->discount;
         $purchase->invoice_total=$request->invoice_total;
         $purchase->bank_detail=$request->bank_detail;
         $purchase->place=$request->place;
         $purchase->action_date=$request->action_date;
         $purchase->signatory_company=$request->signatory_company;
         $purchase->first_name=$request->first_name;
         $purchase->last_name=$request->last_name;
         if($request->hasFile('signature'))
         {
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $purchase->signature=$imagePath;
         }
         //image resize
         
         $purchase->save();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->purchase_number,
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
        return redirect('/purchases')->with('success','Purchase Order Saved as draft');
    }
    public function edit(Purchase $purchase)
    {
        return view('users.purchases.edit',compact('purchase'));
    }
     public function update(Request $request,Purchase $purchase)
    {
        //dd($request->all());
         //dd($request->all());
       
         $purchase->user_id=auth()->user()->id;
         $purchase->purchase_number=$request->purchase_number;
         $purchase->seller_id=$request->seller_id;
         $purchase->buyer_id=$request->buyer_id;
         $purchase->date=$request->date;
         $purchase->buyer_reference=$request->buyer_reference;
         $purchase->delivery_date=$request->delivery_date;
         $purchase->dispatch_id=$request->dispatch_id;
         $purchase->shipment_type=$request->shipment_type;  
         $purchase->loading_id=$request->loading_id;
         $purchase->discharge_id=$request->discharge_id;
         $purchase->payment_method=$request->payment_method;
         $purchase->additional_info=$request->additional_info;
        
         $purchase->discount=$request->discount;
         $purchase->invoice_total=$request->invoice_total;
         $purchase->bank_detail=$request->bank_detail;
         $purchase->place=$request->place;
         $purchase->action_date=$request->action_date;
         $purchase->signatory_company=$request->signatory_company;
         $purchase->first_name=$request->first_name;
         $purchase->last_name=$request->last_name;
         if($request->hasFile('signature'))
         {
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $purchase->signature=$imagePath;
         }else{
             $imagePath=$request->old_image;
             $purchase->signature=$imagePath;
         }
         $purchase->save();
         OrderItem::where('invoice_number',$request->purchase_number)->delete();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->purchase_number,
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
        return redirect('/purchases')->with('success','Saved Changes Successfully');
    }
     public function destroy(Purchase $purchase)
    {  
        //dd($quote);
        $purchase->delete();
    }
     public function getInfo($id)
    {
        $data=Purchase::findOrFail($id);
        $seller_email=Contact::where('id',$data->seller_id)->first()->value('email');
        return response()->json(['data'=>$data,'email'=>$seller_email]);
    }
}
