<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Mail\SendInvoice;
use Illuminate\Support\Str;
use App\Invoice;
use App\OrderItem;
use App\Product;
use DataTables;
use App\Contact;
use \PDF;

class InvoiceController extends Controller
{
    //     
    public function index()  
    {
          if(request()->ajax())
        {
            return DataTables()->of(Invoice::where('user_id',auth()->user()->id)->latest()->get())
                    ->addColumn('action', function($data){
                        // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        // $button .= '&nbsp;&nbsp;';
                        // $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        // return $button;
                        $dropdown  ='<div class="dropdown">';
                        $dropdown .='<button class="btn btn-primary dropdown-toggle" type="button"id="option"data-toggle="dropdown"><i class="fas fa-braille"></i></button>';
                        $dropdown .='<div class="dropdown-menu dropdown-menu-right" aria-labelledby="option">';
                        $dropdown .='<a class="dropdown-item text-muted" href="/invoices/'.$data->id.'/edit"><i class="fas fa-pen mr-3"></i>Edit Document</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/invoices/'.$data->id.'/show"><i class="fas fa-eye mr-3"></i>View</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/invoices/'.$data->id.'/send"><i class="fas fa-paper-plane mr-3"></i>Send</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/invoices/'.$data->id.'/print"> <i class="fas fa-print mr-3"></i>Print</a>';
                        $dropdown .='<div class="dropdown-divider"></div>';
                        $dropdown .='<a class="dropdown-item text-muted" href="/invoices/'.$data->id.'/download"> <i class="fas fa-download mr-3"></i>Download</a>';
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
                            return date('d-m-Y', strtotime($user->created_at) );
                        })
                    ->editColumn('buyer',function($user){
                        $buyer_id=$user->buyer_id;
                        $buyer=Contact::where('id',$buyer_id)->value('first_name');
                        return $buyer;
                    })
                    ->editColumn('type',function($user){
                        return $user->invoice_type?'Commercial':'Profarma';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.invoices.index');
    }
    public function show(Invoice $invoice)
    {
        //dd($invoice);
        if($invoice->invoice_type==1)
        {
            return view('users.invoices.show_commercial',compact('invoice'));

        }else{
             return view('users.invoices.show_profarma',compact('invoice'));
        }
       
    }
    // Profarma invoice
    public function create_profarma()
    {
        return view('users.invoices.create_profarma');
    }
    public function store_profarma(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'invoice_number'=>'required|string|unique:invoices,invoice_number'
        ]);
         $invoice=new Invoice();
         $invoice->user_id=auth()->user()->id;
         $invoice->invoice_number=$request->invoice_number;
         $invoice->seller_id=$request->seller_id;
         $invoice->buyer_id=$request->buyer_id;
         $invoice->date=$request->date;
         $invoice->key=Str::random(40);
         $invoice->buyer_reference=$request->buyer_reference;
         $invoice->delivery_date=$request->delivery_date;
         $invoice->dispatch_id=$request->dispatch_id;
         $invoice->shipment_type=$request->shipment_type;  
         $invoice->loading_id=$request->loading_id;
         $invoice->discharge_id=$request->discharge_id;
         $invoice->payment_method=$request->payment_method;
         $invoice->additional_info=$request->additional_info;
         $invoice->total=$request->total;
         $invoice->discount=$request->discount;
         $invoice->invoice_total=$request->invoice_total;
         $invoice->bank_detail=$request->bank_detail;
         $invoice->place=$request->place;
         $invoice->action_date=$request->action_date;
         $invoice->signatory_company=$request->signatory_company;
         $invoice->first_name=$request->first_name;
         $invoice->last_name=$request->last_name;
         //image resize
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $invoice->signature=$imagePath;
         $invoice->save();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->invoice_number,
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
        return redirect('/invoices')->with('success','Invoice Saved as draft');
    }
    public function get_product(Request $request)
    {
        $product_code=$request->product_code;
        //$product=Product::findOrFail($product_id);
        $product=Product::where('code',$product_code)->get()->first();
        return response()->json(['data' => $product]);
    }
    public function edit(Invoice $invoice)
    {   //dd($invoice);
        if($invoice->type=='Commercial')
        {
             return view('users.invoices.edit_commercial',compact('invoice'));
        }
        else
        {
            return view('users.invoices.edit_profarma',compact('invoice'));
        }
    }
    public function update(Request $request,Invoice $invoice)
    {
         if($invoice->invoice_type==1)
         {
         $invoice->user_id=auth()->user()->id;
         $invoice->invoice_number=$request->invoice_number;
         $invoice->seller_id=$request->seller;
         $invoice->buyer_id=$request->buyer;
         $invoice->date=$request->date;
         //commercial

         $invoice->reference=$request->reference;
         $invoice->vessel=$request->vessel;
         $invoice->voyage_no=$request->voyage_no;
         $invoice->destination=$request->destination;
         $invoice->origin=$request->origin;
         $invoice->final_destination=$request->final_destination;
         $invoice->marine=$request->marine;
         $invoice->credit=$request->credit;
         $invoice->invoice_type=1;
         //commercial

         $invoice->buyer_reference=$request->buyer_reference;
         $invoice->delivery_date=$request->delivery_date;
         $invoice->dispatch_id=$request->dispatch_id;
         $invoice->shipment_type=$request->shipment_type;  
         $invoice->loading_id=$request->loading_id;
         $invoice->discharge_id=$request->discharge_id;
         $invoice->payment_method=$request->payment_method;
         $invoice->additional_info=$request->additional_info;
         $invoice->total=$request->total;
         $invoice->discount=$request->discount;
         $invoice->invoice_total=$request->invoice_total;
         $invoice->bank_detail=$request->bank_detail;
         $invoice->place=$request->place;
         $invoice->action_date=$request->action_date;
         $invoice->signatory_company=$request->signatory_company;
         $invoice->first_name=$request->first_name;
         $invoice->last_name=$request->last_name;
         //image resize
          if($request->hasFile('signature'))
         {
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save(); 
         $invoice->signature=$imagePath;
         }else{
             $imagePath=$request->old_image;
             $invoice->signature=$imagePath;
         }
        
         $invoice->save();
    
         OrderItem::where('invoice_number',$request->invoice_number)->delete();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->invoice_number,
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
        return redirect('/invoices')->with('success','Save Changes Successfully!!');

         }else{

         
         $invoice->user_id=auth()->user()->id;
         $invoice->invoice_number=$request->invoice_number;
         $invoice->seller_id=$request->seller;
         $invoice->buyer_id=$request->buyer;
         $invoice->date=$request->date;
         $invoice->buyer_reference=$request->buyer_reference;
         $invoice->delivery_date=$request->delivery_date;
         $invoice->dispatch_id=$request->dispatch_id;
         $invoice->shipment_type=$request->shipment_type;
         $invoice->loading_id=$request->loading_id;
         $invoice->discharge_id=$request->discharge_id;
         $invoice->payment_method=$request->payment_method;
         $invoice->additional_info=$request->additional_info;
         $invoice->total=$request->total;
         $invoice->discount=$request->discount;
         $invoice->invoice_total=$request->invoice_total;
         $invoice->bank_detail=$request->bank_detail;
         $invoice->place=$request->place;
         $invoice->action_date=$request->action_date;
         $invoice->signatory_company=$request->signatory_company;
         $invoice->first_name=$request->first_name;
         $invoice->last_name=$request->last_name;
         //image resize
         if($request->hasFile('signature'))
         {
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $invoice->signature=$imagePath;
         }else{
             $imagePath=$request->old_image;
             $invoice->signature=$imagePath;
         }
       
         $invoice->save();
         OrderItem::where('invoice_number',$request->invoice_number)->delete();
         //$OrderItem=OrderItem::where('invoice_number',$request->invoice_number)->get();
         $code=$request->code;
         //dd($code);
         
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->invoice_number,
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
    
        return redirect('/invoices')->with('success','Save Changes Successfully!!');
    }

    }
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
    }
    //download
    public function downloadPdf(Invoice $invoice)
    {
        //dd($invoice);
        $pdf=PDF::loadView('users.invoices.pdf',compact('invoice'));
        //dd($pdf);
        return $pdf->download('invoice.pdf');

    }
      //Print
    public function printPdf(Invoice $invoice)
    {
        //dd($invoice);
        $pdf=PDF::loadView('users.invoices.pdf',compact('invoice'));
        //dd($pdf);
        return $pdf->stream('invoice.pdf');

    }
    //invoice send
    public function sendInvoice(Invoice $invoice)
    {   
        $buyer=Contact::where('id',$invoice->buyer_id)->first()->value('email');
        Mail::to($buyer)->send(new SendInvoice($invoice));
        $invoice->update([
            'status'=>1
        ]);
      return redirect()->back();
    }
    // Commercial Invoice
    public function create_commercial()
    {
        return view('users.invoices.create_commercial');
    }
    public function store_commercial(Request $request)
    {
          $request->validate([
            'invoice_number'=>'required|string|unique:invoices,invoice_number'
        ]);
         $invoice=new Invoice();
         $invoice->user_id=auth()->user()->id;
         $invoice->invoice_number=$request->invoice_number;
         $invoice->seller_id=$request->seller;
         $invoice->buyer_id=$request->buyer;
         $invoice->date=$request->date;
         $invoice->key=Str::random(40);
         //commercial

         $invoice->reference=$request->reference;
         $invoice->vessel=$request->vessel;
         $invoice->voyage_no=$request->voyage_no;
         $invoice->destination=$request->destination;
         $invoice->origin=$request->origin;
         $invoice->final_destination=$request->final_destination;
         $invoice->marine=$request->marine;
         $invoice->credit=$request->credit;
         $invoice->invoice_type=1;
         //commercial

         $invoice->buyer_reference=$request->buyer_reference;
         $invoice->delivery_date=$request->delivery_date;
         $invoice->dispatch_id=$request->dispatch_id;
         $invoice->shipment_type=$request->shipment_type;  
         $invoice->loading_id=$request->loading_id;
         $invoice->discharge_id=$request->discharge_id;
         $invoice->payment_method=$request->payment_method;
         $invoice->additional_info=$request->additional_info;
         $invoice->total=$request->total;
         $invoice->discount=$request->discount;
         $invoice->invoice_total=$request->invoice_total;
         $invoice->bank_detail=$request->bank_detail;
         $invoice->place=$request->place;
         $invoice->action_date=$request->action_date;
         $invoice->signatory_company=$request->signatory_company;
         $invoice->first_name=$request->first_name;
         $invoice->last_name=$request->last_name;
         //image resize
         $imagePath=$request->signature->store('uploads','public');
         $image=Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
         $image->save();
         $invoice->signature=$imagePath;
         $invoice->save();
         $code=$request->code;
        for($i=0;$i<count($code);$i++)
        {
            $data=array(
                'invoice_number'=>$request->invoice_number,
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
        return redirect('/invoices')->with('success','Invoice Saved as draft');

    }
}
