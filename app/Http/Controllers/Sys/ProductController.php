<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\Vw_product;
use App\Models\Sys\Views\Vw_product_type;
use App\Models\Sys\Views\Vw_unit;
use App\Models\Sys\SysProduct;
use App\Models\Sys\SysMaster;
use App\Models\Sys\SysProductType;
use App\Models\Sys\SysUnit;
use Datatables;
use Validator;

class ProductController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('sys.product_list');
  }

  public function edit(Request $request){

    $vw_product = new Vw_product;
    $product_id = 0;

    if(!empty($request->id)){
      $vw_product = Vw_product::find($request->id);
      $product_id = $request->id;
    }

    $product_type = Vw_product_type::all();

    $unit = Vw_unit::fromView($product_id)->get();

    $sysMaster = SysMaster::all();

    return view('sys.product')->with(compact('vw_product','product_type','sysMaster', 'unit'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';
    $validate['type'] = 'required';
    $validate['split'] = 'required';
    $validate['unit'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      if(!empty($request->id)){
        $sysProduct = SysProduct::find($request->id);
      }else{
        $sysProduct = new SysProduct;
      }


      $sysProduct->name = $request->name;
      $sysProduct->cat = $request->type;
      $sysProduct->split = $request->split;
      $sysProduct->save();

      $unit = SysUnit::where('product_id', $sysProduct->id);
      $unit->delete();

      $units = $request->unit;

      for($i=0; $i < count($units); $i++){
        $unit = new SysUnit;
        $unit->product_id = $sysProduct->id;
        $unit->master_id = $units[$i];
        $unit->save();
      }

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $sysProduct = SysProduct::find($request->id);
        $sysProduct->delete();

        $unit = SysUnit::where('product_id', $request->id);
        $unit->delete();
      }

      return response()->json(['type' => 'success']);

  }

  public function datalist(){
    return Datatables::of(Vw_product::all())->make(true);
  }

}
