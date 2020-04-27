<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Contact;
use Validator;

class ContactController extends Controller
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
            return DataTables()->of(Contact::where('user_id',auth()->user()->id)->latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.contact.index');
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
            'company_name'  =>  'required',
            'logo'          =>  'required|image|max:2048',
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required|email',
            'phone'         =>  'required|digits:11',
            'address'       =>  'required',
            'country'       =>  'required',
            'city'          =>  'required',
            'state'         =>  'required',
            'zip'           =>  'required',
    
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('logo');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);

        $form_data = array(
           'company_name'  =>   $request->company_name,
            'user_id'=>Auth::user()->id,
            'logo'          =>  $new_name,
            'first_name'    =>  $request->first_name,
            'last_name'     =>   $request->last_name,
            'email'         =>   $request->email,
            'phone'         =>   $request->phone,
            'address'       =>   $request->address,
            'country'       =>   $request->country,
            'city'          =>   $request->city,
            'state'         =>   $request->state,
            'zip'           =>   $request->zip,
        );

        Contact::create($form_data);

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
            $data = Contact::findOrFail($id);
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
        $image_name = $request->hidden_image;
        $image = $request->file('logo');
        if($image != '')
        {
            $rules = array(
            'company_name'  =>  'required',
            'logo'          =>  'required|image|max:2048',
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required|email',
            'phone'         =>  'required|digits:11',
            'address'       =>  'required',
            'country'       =>  'required',
            'city'          =>  'required',
            'state'         =>  'required',
            'zip'           =>  'required',
    
        );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else
        {
            $rules = array(
            'company_name'  =>  'required',
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required|email',
            'phone'         =>  'required|digits:11',
            'address'       =>  'required',
            'country'       =>  'required',
            'city'          =>  'required',
            'state'         =>  'required',
            'zip'           =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
           'company_name'  =>   $request->company_name,
            'user_id'=>Auth::user()->id,
            'logo'          =>  $image_name,
            'first_name'    =>  $request->first_name,
            'last_name'     =>   $request->last_name,
            'email'         =>   $request->email,
            'phone'         =>   $request->phone,
            'address'       =>   $request->address,
            'country'       =>   $request->country,
            'city'          =>   $request->city,
            'state'         =>   $request->state,
            'zip'           =>   $request->zip,
        );
        Contact::whereId($request->hidden_id)->update($form_data);

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
        $data = Contact::findOrFail($id);
        $data->delete();
    }
}
