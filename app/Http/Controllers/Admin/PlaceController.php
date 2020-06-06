<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use App\Place;

class PlaceController extends Controller
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
            return DataTables()->of(Place::all())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.places');
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
            'name'  =>  'required|min:3|unique:places,name',
            );
          $error = Validator::make($request->all(), $rules);
          if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        $form_data = array(
           'name'  =>   $request->name,
         );
       // $check_country=Place::where('name',$form_data['name'])->first();
        

        Place::create($form_data);
        return response()->json(['success' => 'Place is successfully Created!']);
        
        
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
            $data = Place::findOrFail($id);
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
    public function update(Request $request,$id)
    {
         $rules = array(
             'name'  =>  'required|min:3|unique:places,name',
            );
          $error = Validator::make($request->all(), $rules);
          if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        $form_data = array(
           'name'  =>   $request->name,
         );
        $place=Place::find($id);
        $place->update($form_data);
       // Place::whereId($id)->update($form_data);
        return response()->json(['success' => 'Place is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Place::findOrFail($id);
        $data->delete();
    }
}
