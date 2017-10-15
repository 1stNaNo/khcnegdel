<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcPurchaser;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcPurchaser;
use Datatables;

class PurchaserController extends Controller
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
      return view('khc.purchaser.purchaser_list');
    }

    public function edit(Request $request){
      $purchaser = new VwKhcpurchaser;

      if(!empty($request->id)){
        $purchaser = VwKhcpurchaser::find($request->id);
      }

      $cities = SysAddress::where('type', 'city')->get();
      $districts = SysAddress::where('type', 'district')->get();
      return view('khc.purchaser.purchaser_update')->with(compact('purchaser', 'cities', 'districts'));
    }

    public function save(Request $request){
      if(!empty($request->wh_id)){
        $purchaser = Khcpurchaser::find($request->wh_id);
      }else{
        $purchaser = new Khcpurchaser;  
      }

      if(!$request->has('is_centre')){
        $purchaser->is_centre = 0;
      }else{
        $purchaser->is_centre = 1;
      }
      
      $purchaser->fill($request->all());
      $purchaser->save();

      return response()->json(['type' => 'success']);
    }

    public function data(){
      return Datatables::of(VwKhcpurchaser::all())->make(true);
    }
}
