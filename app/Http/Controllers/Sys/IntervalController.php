<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysInterval;
use Datatables;
use Validator;

class IntervalController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    $sysInterval = new SysInterval;

    $sysInterval = SysInterval::all()->first();

    return view('sys.interval')->with(compact('sysInterval'));
  }


  public function save(Request $request){

    $validate = [];
    $validate['start_day'] = 'required';
    $validate['start_time'] = 'required';
    $validate['end_day'] = 'required';
    $validate['end_time'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{

      $sysInterval = SysInterval::all()->first();

      $sysInterval->start_day = $request->start_day;
      $sysInterval->start_time = $request->start_time;
      $sysInterval->end_day = $request->end_day;
      $sysInterval->end_time = $request->end_time;
      $sysInterval->save();

      return response()->json(['type' => 'success']);
    }

  }

}
