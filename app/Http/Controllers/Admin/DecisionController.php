<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Http\Controllers\Controller;
use Datatables;

class DecisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }
    public function index(){
    	return view('admin.decision');
    }

    public function complaintsList(Request $request){
    		return Datatables::of(Complaint::all())->make(true);
    }

    public function decisionregister(Request $request){
    	return view('admin.decisionregister')->with("id", $request->id);
    }

    public function save(Request $request){
   		$c = Complaint::find($request->id);
   		$c->decision = $request->decision;
   		$c->kind = $request->kind;
   		$c->type = 1;
   		$c->save();
   		return $c;
    }
}
