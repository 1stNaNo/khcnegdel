<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysAddress;
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


    return view('sys.address')->with(compact("parent", "child"));
  }

  public function edit(Request $request){
    $sysClient = new SysClient;
    if(!empty($request->id)){
      $sysClient = SysClient::find($request->id);
    }

    return view('sys.clients')->with(compact('sysClient'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';
    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{

      Udb::save($request->all(), SysClient::class, []);

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $sysClient = SysClient::find($request->id);
        $sysClient->delete();
      }

      return response()->json(['type' => 'success']);

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

  public function datalist(Request $request){

    $condition = [];
    $condition["name"] = "LIKE";

    $sysclient = Udb::find($request->params, SysAddress::class, $condition);

    return Datatables::of($sysclient)->make(true);
  }

}
