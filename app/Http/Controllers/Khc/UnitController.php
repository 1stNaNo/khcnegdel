<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\KhcUnit;
use App\Utilities\Udb;
use App\Utilities\Tools;
use Datatables;
use Validator;

class UnitController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){

    return view('khc.unit.list');
  }

  public function update(Request $request){

    $model = new KhcUnit;
    if(!empty($request->id)){
      $model = KhcUnit::find($request->id);
    }

    return view('khc.unit.update')->with(compact('model'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';
    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{

      $data = $request->all();

      $data = Udb::save($data, KhcUnit::class, []);

      return response()->json(['type' => 'success', 'data'=> $data]);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $model = KhcUnit::find($request->id);
        $model->delete();
      }

      return response()->json(['type' => 'success', 'data'=>$sysAddress]);

  }

  public function datalist(Request $request){

    $condition = [];
    $condition["name"] = "LIKE";

    $sysclient = Udb::find($request->params, KhcUnit::class, $condition);

    return Datatables::of($sysclient)->make(true);
  }

}
