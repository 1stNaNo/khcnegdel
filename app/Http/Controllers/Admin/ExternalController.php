<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\External;

class ExternalController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){

      return \View::make('admin.external');
    }

    public function anyData()
    {
      return Datatables::of(External::all())->make(true);
    }

    public function indexA(Request $request){


      $external = null;

      if($request->isEdit && !empty($request->id)){
          $external = External::find($request->id);
      }

      return \View::make('admin.external_action')->with(compact('external'));
    }

    public function save(Request $request){

      $external = new External;


      $validate = [];
      $validate["link"] = "required";
      $validate["count"] = "required";

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{

        if(!empty($request->id)){
          $external = External::find($request->id);
        }

        $external->link = $request->link;
        $external->count = $request->count;

        $external->save();

        return response()->json(['type' => 'success']);
      }

    }

    public function edit()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function remove(Request $request){

      $external = External::find($request->id);
      $external->delete();

      return response()->json(['type' => 'success']);
    }

}
