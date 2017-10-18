<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcCost;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcCost;
use Datatables;
use App\Utilities\Udb;

class CostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('lang');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('khc.cost.cost_list');
    }

    public function edit(Request $request){
      $cost = new KhcCost;

      if(!empty($request->cost_id)){
        $cost = KhcCost::find($request->cost_id);
      }

      return view('khc.cost.cost_update')->with(compact('cost'));
    }

    public function save(Request $request){
      
      $validate = [];
      $validate['name'] = 'required';

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{

        if(!empty($request->cost_id)){
          $cost = KhcCost::find($request->cost_id);
        }else{
          $cost = new KhcCost;  
        }
        
        $cost->fill($request->all());
        $cost->save();

        return response()->json(['type' => 'success']);
      }
    }

    public function data(Request $request){
      $c = [];
      $c['name'] = "LIKE";
      return Datatables::of(Udb::find($request->params, KhcCost::class, $c))->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->id)){
        $cost = KhcCost::find($request->id);
        $cost->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
