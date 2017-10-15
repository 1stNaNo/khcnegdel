<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysAddress;
use App\Models\Sys\Views\Vw_address;
use App\Utilities\Udb;
use App\Utilities\Tools;
use Datatables;
use Validator;

class AddressController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){

    $parent = SysAddress::where("parent_id", 0)->get();
    $childs = array();

    array_push($childs, 0);

    foreach($parent as $item){
      array_push($childs, $item->id);
    }

    $child = SysAddress::whereIn("parent_id", $childs)->get();


    return view('sys.address.list')->with(compact("parent", "child"));
  }

  public function update(Request $request){

    $sysAddress = new SysAddress;
    $sysAddress->parent_id = $request->parent_id;
    if(!empty($request->id)){
      $sysAddress = SysAddress::find($request->id);
    }

    return view('sys.address.update')->with(compact('sysAddress'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';
    $validate['code'] = 'required';
    $validate['type'] = 'required';
    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{

      $data = $request->all();

      if(!$request->has('parent_id')){
        $data["parent_id"] = 0;
      }

      $data = Udb::save($data, SysAddress::class, []);

      return response()->json(['type' => 'success', 'data'=> $data]);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $sysAddress = SysAddress::find($request->id);
        $sysAddress->delete();
      }

      return response()->json(['type' => 'success', 'data'=>$sysAddress]);

  }

  public function tree(Request $request){

    $parent = SysAddress::where("parent_id", 0)->get();
    $childs = array();

    array_push($childs, 0);

    foreach($parent as $item){
      array_push($childs, $item->id);
    }

    $child = SysAddress::whereIn("parent_id", $childs)->get();

    return Tools::treeNode($child, true);
  }

  public function treeNode(Request $request){

      $child = SysAddress::where("parent_id", $request->id)->get();

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

    $sysclient = Udb::find($request->params, Vw_address::class, $condition);

    return Datatables::of($sysclient)->make(true);
  }

}
