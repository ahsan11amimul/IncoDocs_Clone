<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Product;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         if(request()->ajax())
        {
            return DataTables()->of(Product::where('user_id',auth()->user()->id)->latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $rules = array(
            'code'          =>  'required',
            'description'   =>  'required',
            'sell_price'    =>  'required',
            'buy_price'     =>  'required',
            'unit'          =>   'required',
            'country'       =>  'required',
            'hs_code'       =>  'required'
            
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

      

        $form_data = array(
            'code'          =>   $request->code,
            'user_id'       =>   Auth::user()->id,
            'description'   =>   $request->description,
            'sell_price'    =>   $request->sell_price,
            'buy_price'     =>   $request->buy_price,
            'unit'          =>   $request->unit,
            'country'       =>   $request->country,
            'hs_code'       =>   $request->hs_code
        );

        Product::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(request()->ajax())
        {
            $data = Product::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
            $rules = array(
            'code'          =>  'required',
            'description'   =>  'required',
            'sell_price'    =>  'required',
            'buy_price'     =>  'required',
            'unit'          =>   'required',
            'country'       =>  'required',
            'hs_code'       =>  'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        

        $form_data = array(
            'code'          =>   $request->code,
            'user_id'       =>   Auth::user()->id,
            'description'   =>   $request->description,
            'sell_price'    =>   $request->sell_price,
            'buy_price'     =>   $request->buy_price,
            'unit'          =>   $request->unit,
            'country'       =>   $request->country,
            'hs_code'       =>   $request->hs_code
        );
        Product::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
    }
}
