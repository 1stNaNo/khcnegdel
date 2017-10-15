<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\Vw_product_type;
use App\Models\Sys\SysProductType;
use Datatables;
use Validator;

class ProductTypeController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('sys.producttype_list');
  }

  public function edit(Request $request){

    $vw_product_type = new Vw_product_type;

    $reqId = 0;

    if(!empty($request->id)){
      $reqId = $request->id;
      $vw_product_type = Vw_product_type::find($request->id);
    }

    $product_type = Vw_product_type::fromView($reqId)->get();

    return view('sys.producttype')->with(compact('vw_product_type','product_type'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';
    $validate['numb'] = 'required';
    $validate['parent'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      if(!empty($request->id)){
        $sysProductType = SysProductType::find($request->id);
      }else{
        $sysProductType = new SysProductType;
      }

      $sysProductType->name = $request->name;
      $sysProductType->parent_id = $request->parent;
      $sysProductType->numb = $request->numb;
      $sysProductType->save();

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $sysProductType = SysProductType::find($request->id);
        $sysProductType->delete();
      }

      return response()->json(['type' => 'success']);

  }

  public function datalist(){
    return Datatables::of(Vw_product_type::all())->make(true);
  }

}
