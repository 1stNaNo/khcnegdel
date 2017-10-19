<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcSupplier;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcSupplier;
use Datatables;
use App\Utilities\Udb;

class SupplierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $countries = SysAddress::where('type', 'country')->get();
      return view('khc.supplier.supplier_list')->with(compact('countries'));
    }

    public function edit(Request $request){
      $supplier = new VwKhcSupplier;

      if(!empty($request->id)){
        $supplier = VwKhcSupplier::find($request->id);
        $districts = SysAddress::find($supplier->district_id);
        $cities = SysAddress::find($supplier->city_id);
      }

      $countries = SysAddress::where('type', 'country')->get();
      return view('khc.supplier.supplier_update')->with(compact('supplier', 'cities', 'districts', 'countries'));
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

        if(!empty($request->supplier_id)){
          $supplier = KhcSupplier::find($request->supplier_id);
        }else{
          $supplier = new KhcSupplier;  
        }
        
        $supplier->fill($request->all());
        $supplier->save();

        return response()->json(['type' => 'success']);
      }
    }

    public function data(Request $request){
      $c = [];
      $c['name'] = "LIKE";
      $c['phone'] = "LIKE";
      return Datatables::of(Udb::find($request->params, VwKhcSupplier::class, $c))->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->id)){
        $supplier = KhcSupplier::find($request->id);
        $supplier->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
