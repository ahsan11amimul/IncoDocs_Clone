<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Detail;
use Validator;

class DetailController extends Controller
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
            return DataTables()->of(Detail::where('user_id',auth()->user()->id)->latest()->get())
            
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })->editColumn('updated_at', function ($user) 
                        {
                            //change over here
                            return date('d-m-Y', strtotime($user->updated_at) );
                        })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.detail.index');
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
            'name'          =>  'required',
            'description'   =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

      

        $form_data = array(
            'name'          =>   $request->name,
            'user_id'       =>   Auth::user()->id,
            'description'   =>   $request->description,
        );

        Detail::create($form_data);

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
            $data = Detail::findOrFail($id);
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
            'name'          =>  'required',
            'description'   =>  'required',
        );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        

        $form_data = array(
            'name'          =>   $request->name,
            'user_id'       =>   Auth::user()->id,
            'description'   =>   $request->description,
        );

        Detail::whereId($request->hidden_id)->update($form_data);

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
        $data = Detail::findOrFail($id);
        $data->delete();
    }
}
