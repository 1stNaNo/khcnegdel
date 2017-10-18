<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcCostTemplate;
use App\Models\Sys\Views\VwKhcWarehouse;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcCostTemplate;
use App\Models\Sys\KhcCost;
use Datatables;
use App\Utilities\Udb;

class CostTemplateController extends Controller
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
      return view('khc.costtemplate.costtemplate_list');
    }

    public function edit(Request $request){
      $costtemplate = new VwKhcCostTemplate;
      $warehouses = VwKhcWarehouse::all();
      $costs = KhcCost::all();

      if(!empty($request->cost_template_id)){
        $costtemplate = VwKhcCostTemplate::find($request->cost_template_id);
        $costs = VwKhcCostTemplate::where('wh_id', $costtemplate->wh_id)->get();
      }

      return view('khc.costtemplate.costtemplate_update')->with(compact('costtemplate', 'warehouses', 'costs'));
    }

    public function save(Request $request){
      
      $validate = [];

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{
        $costs = KhcCost::all();

        $costtemplate = KhcCostTemplate::where('wh_id',$request->wh_id);
        $costtemplate->delete();
        
        foreach($costs as $c){
          if(!empty($request->amount[$c->cost_id])){
            $costtemplate = new KhcCostTemplate;
            $costtemplate->wh_id = $request->wh_id;
            $costtemplate->cost_id = $c->cost_id;
            $costtemplate->amount = $request->amount[$c->cost_id];
            $costtemplate->save(); 
          }
        }

        return response()->json(['type' => 'success']);
      }
    }

    public function data(Request $request){
      $c = [];
      $c['name'] = "LIKE";
      $c['phone'] = "LIKE";
      return Datatables::of(Udb::find($request->params, VwKhcCostTemplate::class, $c))->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->id)){
        $costtemplate = KhcCostTemplate::find($request->id);
        $costtemplate->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
