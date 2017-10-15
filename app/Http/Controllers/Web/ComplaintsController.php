<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Models\Views\Vw_poll;
use App\Models\Views\Vw_answer;

class ComplaintsController extends Controller
{
    public function save(Request $request){

      $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

      $url = "/complaints";

      $redirect = redirect()->to($url);

      if(!$validator->fails()){
        $complaint = new Complaint;
        $complaint->name = $request->name;
        $complaint->email = $request->email;
        $complaint->content = $request->message;
        $complaint->type = 0;
        $complaint->kind = 0;
        $complaint->insert_date = \DB::raw('NOW()');

        $complaint->save();

        $redirect->with('status','true');

      }else{
        $redirect->withInput($request->input());
      }

      return $redirect->withErrors($validator);

    }

    public function complaintInfo(){
      return Complaint::all();
    }

    public function pollInfo(){

      $poll = Vw_poll::where('active_flag', 1)->first();

      return Vw_answer::where('poll_id', $poll->id)->where('lang', \Session::get('lang'))->get();
    }

}
