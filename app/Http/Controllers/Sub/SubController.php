<?php

namespace App\Http\Controllers\Sub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(Request $request){

    $page = $request->page;
    $sub = $request->sub;
    $class = str_replace('/', '', $page);

    return view('sub.index')->with(compact("page", "sub", "class"));
  }

}
