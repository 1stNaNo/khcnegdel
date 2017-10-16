<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\KhcProduct;
use App\Models\Sys\KhcPurchaser;
use App\Models\Sys\KhcUnit;
use App\Models\Sys\KhcProductUnit;
use App\Models\Sys\Views\Vw_khc_product;
use App\Utilities\Udb;
use App\Utilities\Tools;
use Datatables;
use Validator;

class ProductController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){

    $model = KhcPurchaser::where('type', 1)->get();

    return view('khc.product.list')->with(compact('model'));
  }

  public function update(Request $request){

    $purchaser = KhcPurchaser::where('type', 1)->get();
    $unit = KhcUnit::all();
    $unit_prod =  new KhcProductUnit;

    $model = new KhcProduct;
    $model->parent_id = $request->parent_id;
    if(!empty($request->id)){
      $model = KhcProduct::find($request->id);
      $unit_prod =  KhcProductUnit::where("product_id", $model->id)->get();
    }

    return view('khc.product.update')->with(compact('model','purchaser','unit','unit_prod'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';
    $validate['code'] = 'required';
    $validate['type'] = 'required';
    if($request->type == 2){
      $validate['unit'] = 'required';
      $validate['suplier'] = 'required';
    }
    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{

      $data = $request->all();

      unset($data["unit"]);

      if(!$request->has('parent_id')){
        $data["parent_id"] = 0;
      }

      if(empty($data["suplier"])){
        $data["suplier"] = 0;
      }

      $data = Udb::save($data, KhcProduct::class, []);

      $unit = KhcProductUnit::where('product_id', $data->id);
      $unit->delete();

      if($request->type == 2){
        $units = $request->unit;

        for($i=0; $i < count($units); $i++){
          $unit = new KhcProductUnit;
          $unit->product_id = $data->id;
          $unit->master_id = $units[$i];
          $unit->save();
        }
      }

      return response()->json(['type' => 'success', 'data'=> $data]);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $model = KhcProduct::find($request->id);
        $model->delete();

        $unit = KhcProductUnit::where('product_id', $model->id);
        $unit->delete();

      }

      return response()->json(['type' => 'success', 'data'=>$model]);

  }

  public function tree(Request $request){

    $parent = KhcProduct::where("parent_id", 0)->where("type", 1)->get();
    $childs = array();

    array_push($childs, 0);

    foreach($parent as $item){
      array_push($childs, $item->id);
    }

    $child = KhcProduct::whereIn("parent_id", $childs)->where("type", 1)->get();

    return Tools::treeNode($child, true);
  }

  public function treeNode(Request $request){

      $child = KhcProduct::where("parent_id", $request->id)->where("type", 1)->get();

      return Tools::treeNode($child, false);
  }

  public function getChild(Request $request){

    $sysAddress = new SysAddress;

    if(!empty($request->id)){
      $sysAddress = SysAddress::where("parent_id",$request->id)->get();
    }

    return $sysAddress;
  }

  public function datalist(Request $request){

    $condition = [];
    $condition["name"] = "LIKE";
    $condition["code"] = "LIKE";

    $sysclient = Udb::find($request->params, Vw_khc_product::class, $condition);

    return Datatables::of($sysclient)->make(true);
  }

}
