<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Views\Vw_user;
use Datatables;


class RoleController extends Controller{


  public function __construct()
  {
      $this->middleware('lang');
      $this->middleware('auth');
  }


  public function index(Request $request){

    return view('admin.role');
  }

  public function data(Request $request){
      return Datatables::of(Role::all())->make(true);
  }

  public function update(Request $request){

    $role = new Role;

    if(!empty($request->id)){
      $role = Role::find($request->id);
    }

    $permission = Permission::all();

    $role_permissions = $role->perms()->get();

    $rp = [];

    foreach($role_permissions as $item){
      $rp["key".$item->id] = true;
    }

    return view('admin.role_action')->with(compact('role','permission', 'rp'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required|max:255';
    $validate['display_name'] = 'required|max:255';
    $validate['description'] = 'required|max:255';

    $v = Validator::make($request->all(), $validate);

    if($v->fails()){
      return response()->json(['errors'=>$v->messages(), 'status'=>422], 200);
    }

    $role = new Role;

    if(!empty($request->id)){
      $role = Role::find($request->id);
    }

    $role->name = $request->name;
    $role->display_name = $request->display_name;
    $role->description = $request->description;

    $role->save();

    $permissions = array();

    if(!empty($request->permission)){
      foreach($request->permission as $item){
        if(!empty($item)){
            array_push($permissions, $item);
        }
      }
    }

    $role->perms()->sync($permissions);


    return response()->json(['type' => 'success']);
  }

  public function remove(Request $request){

    $role = Role::find($request->id);
    
    $permissions = array();

    $role->perms()->sync($permissions);

    $role->delete();

    return response()->json(['type' => 'success']);
  }
}
