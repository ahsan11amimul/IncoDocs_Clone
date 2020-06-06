<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    //
    public function index()
    {
        //dd(User::all());
          //
         if(request()->ajax())
        {
            return DataTables()->of(User::all())
                    ->addColumn('action', function($data){
                        // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        // $button .= '&nbsp;&nbsp;';
                        $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.users');
    }
    public function store(Request $request)
    {
          //
         $rules = array(
            'name'  =>  'required|min:3|max:60|string',
            'email' =>  'required|email',
            'password'=> 'required|string|min:6|max:16',
            'is_admin'=> 'required'
            );
          $error = Validator::make($request->all(), $rules);
          if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        $form_data = array(
           'name'  =>    $request->name,
           'email' =>    $request->email,
           'password'=>  $request->password,
           'is_admin'=>  $request->is_admin,
           'email_verified'=>1,
           'email_verification_token'=>'22',
           'email_verified_at'=>Carbon::now()->toDateTimeString()
         );
       // $check_country=Country::where('name',$form_data['name'])->first();
        

        User::create($form_data);
        return response()->json(['success' => 'User is successfully Created!']);
    }
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }
}
