<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcPurchaser;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcPurchaser;
use Datatables;
use App\Utilities\Udb;

class PurchaserController extends Controller
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
      return view('khc.purchaser.purchaser_list')->with(compact('countries'));
    }

    public function edit(Request $request){
      $purchaser = new VwKhcPurchaser;

      if(!empty($request->id)){
        $purchaser = VwKhcPurchaser::find($request->id);
        $districts = SysAddress::find($purchaser->district_id);
        $cities = SysAddress::find($purchaser->city_id);
      }

      $countries = SysAddress::where('type', 'country')->get();
      return view('khc.purchaser.purchaser_update')->with(compact('purchaser', 'cities', 'districts', 'countries'));
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

        if(!empty($request->purchaser_id)){
          $purchaser = KhcPurchaser::find($request->purchaser_id);
        }else{
          $purchaser = new KhcPurchaser;  
        }
        
        $purchaser->fill($request->all());
        $purchaser->save();

        return response()->json(['type' => 'success']);
      }
    }

    public function data(Request $request){
      $c = [];
      $c['name'] = "LIKE";
      $c['phone'] = "LIKE";
      return Datatables::of(Udb::find($request->params, VwKhcPurchaser::class, $c))->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->id)){
        $purchaser = KhcPurchaser::find($request->id);
        $purchaser->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
