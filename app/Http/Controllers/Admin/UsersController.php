<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Sys\SysClient;
use Datatables;
use Validator;

class UsersController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('admin.user_list');
  }

  public function userslist(){
    return Datatables::of(User::all())->make(true);
  }

  public function indexnewuser(Request $request){
    $user = new User;
    if(!empty($request->id)){
      $user = User::find($request->id);
    }

    $roles = Role::all();
    $clients = SysClient::all();



    return view('admin.user')->with(compact('user'))->with(compact('roles','clients'));
  }

  public function passwordReset(Request $request){
    return view('admin.password');
  }

  public function passwordSave(Request $request){
    $validate = [];
    $validate['password'] = 'required|min:6|confirmed';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      $user = User::find(\Auth::user()->user_id);
      $user->password = bcrypt($request->password);
      $user->save();

      return response()->json(['type' => 'success']);
    }

  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required|max:255';
    $validate['password'] = 'required|min:6|confirmed';

    if(!empty($request->id)){
      $validate['email'] = 'required|email|max:255';
    }else{
      $validate['email'] = 'required|email|max:255|unique:users';
    }

    $validator = \Validator::make($request->all(), $validate);
    if($validator->fails())
      return response()->json($validator->messages(), 200);

    $user = new User;
    if(!empty($request->id)){
      $user = User::find($request->id);
    }
    $user->name = $request->name;
    $user->email = $request->email;
    $user->org_id = $request->client;
    $user->password = bcrypt($request->password);

    $user->save();
    $user->detachAllRoles();
    $user->attachRole($request->role);

    return response()->json(['type' => 'success']);
  }

  public function remove(Request $request){
    $user = User::find($request->id);
    $user->detachAllRoles();
    $user->delete();
    return response()->json(['type' => 'success']);
  }

}
