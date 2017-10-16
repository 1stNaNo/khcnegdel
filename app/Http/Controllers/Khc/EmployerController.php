<?php

namespace App\Http\Controllers\Khc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sys\Views\VwKhcEmployer;
use App\Models\Sys\SysAddress;
use App\Models\Sys\KhcEmployer;
use App\Models\Sys\KhcWarehouse;
use Datatables;
use App\Utilities\Udb;

class EmployerController extends Controller
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
      $cities = SysAddress::where('type', 'city')->get();
      $districts = SysAddress::where('type', 'district')->get();
      $countries = SysAddress::where('type', 'country')->get();
      $warehouses = KhcWarehouse::all();
      return view('khc.employer.employer_list')->with(compact('cities', 'districts', 'countries', 'warehouses'));
    }

    public function edit(Request $request){
      $employer = new VwKhcEmployer;
      if(!empty($request->id)){
        $employer = VwKhcEmployer::find($request->id);
        $districts = SysAddress::find($employer->district_id);
        $cities = SysAddress::find($employer->city_id);
      }

      $countries = SysAddress::where('type', 'country')->get();
      $warehouses = KhcWarehouse::all();
      return view('khc.employer.employer_update')->with(compact('employer', 'cities', 'districts', 'countries', 'warehouses'));
    }

    public function save(Request $request){

      $validate = [];
      $validate['firstname'] = 'required';
      $validate['lastname'] = 'required';
      $validate['country_id'] = 'required';
      $validate['city_id'] = 'required';
      $validate['district_id'] = 'required';
      $validate['phone'] = 'numeric';

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{
        if(!empty($request->emp_id)){
          $employer = KhcEmployer::find($request->emp_id);
        }else{
          $employer = new KhcEmployer;  
        }
        
        $employer->fill($request->all());
        $employer->save();

        return response()->json(['type' => 'success']);
      }
    }

    public function data(Request $request){
      $c = [];
      $c['firstname'] = "LIKE";
      $c['lastname'] = "LIKE";
      $c['phone'] = "LIKE";
      return Datatables::of(Udb::find($request->params, VwKhcEmployer::class, $c))->make(true);
    }

    public function delete(Request $request){
      if(!empty($request->emp_id)){
        $employer = KhcEmployer::find($request->emp_id);
        $employer->delete();
        return response()->json(['type' => 'success']);
      }
    }
}
