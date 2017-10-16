<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcWarehouse;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcWarehouse;
use Datatables;
use App\Utilities\Udb;

class WarehouseController extends Controller
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
      $countries = SysAddress::where('type', 'country')->get();
      return view('khc.warehouse.warehouse_list')->with(compact('countries'));
    }

    public function edit(Request $request){
      $warehouse = new VwKhcWarehouse;

      if(!empty($request->id)){
        $warehouse = VwKhcWarehouse::find($request->id);
        $districts = SysAddress::find($warehouse->district_id);
        $cities = SysAddress::find($warehouse->city_id);
      }

      $countries = SysAddress::where('type', 'country')->get();
      return view('khc.warehouse.warehouse_update')->with(compact('warehouse', 'cities', 'districts', 'countries'));
    }

    public function save(Request $request){


      $validate = [];
      $validate['name'] = 'required';
      $validate['country_id'] = 'required';
      $validate['city_id'] = 'required';
      $validate['district_id'] = 'required';
      $validate['phone'] = 'numeric';

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{

        if(!empty($request->wh_id)){
          $warehouse = KhcWarehouse::find($request->wh_id);
        }else{
          $warehouse = new KhcWarehouse;  
        }

        if(!$request->has('is_centre')){
          $warehouse->is_centre = 0;
        }else{
          $warehouse->is_centre = 1;
        }
        
        $warehouse->fill($request->all());
        $warehouse->save();

        return response()->json(['type' => 'success']);
      }
    }

    public function data(Request $request){
      $c = [];
      $c['name'] = "LIKE";
      $c['phone'] = "LIKE";
      return Datatables::of(Udb::find($request->params, VwKhcWarehouse::class, $c))->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->wh_id)){
        $warehouse = KhcWarehouse::find($request->wh_id);
        $warehouse->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
