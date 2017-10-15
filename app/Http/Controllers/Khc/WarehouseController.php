<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcWarehouse;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcWarehouse;
use Datatables;

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
      return view('khc.warehouse.warehouse_list');
    }

    public function edit(Request $request){
      $warehouse = new VwKhcWarehouse;

      if(!empty($request->id)){
        $warehouse = VwKhcWarehouse::find($request->id);
      }

      $cities = SysAddress::where('type', 'city')->get();
      $districts = SysAddress::where('type', 'district')->get();
      return view('khc.warehouse.warehouse_update')->with(compact('warehouse', 'cities', 'districts'));
    }

    public function save(Request $request){
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

    public function data(){
      return Datatables::of(VwKhcWarehouse::all())->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->wh_id)){
        $warehouse = KhcWarehouse::find($request->wh_id);
        $warehouse->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
