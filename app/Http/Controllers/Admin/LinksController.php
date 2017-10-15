<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;
class LinksController extends Controller{
  public function __construct(){
      $this->middleware('lang');
      $this->middleware('auth');
  }

  public function index(){
    $links = Link::all();
    return view('admin.links')->with(compact('links'));
  }

  public function save(Request $request){
    foreach ($request->id as $id) {
      $link = Link::find($id);
      $link->link = $request->link[$id];
      $link->save();
    }

    return response()->json(['type' => 'success']);
  }
}
