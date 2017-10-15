<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysMaster;
use Datatables;
use Validator;

class MastersController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('sys.masters_list');
  }

  public function edit(Request $request){
    $sysMaster = new SysMaster;
    if(!empty($request->id)){
      $sysMaster = SysMaster::find($request->id);
    }

    return view('sys.masters')->with(compact('sysMaster'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      if(!empty($request->id)){
        $sysMaster = SysMaster::find($request->id);
      }else{
        $sysMaster = new SysMaster;
      }

      $sysMaster->name = $request->name;
      $sysMaster->type = $request->type;
      $sysMaster->save();

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $sysMaster = SysMaster::find($request->id);
        $sysMaster->delete();
      }

      return response()->json(['type' => 'success']);

  }

  public function datalist(){
    return Datatables::of(SysMaster::all())->make(true);
  }

}
