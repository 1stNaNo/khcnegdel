<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Views\Vw_title;
use App\Models\Title;
use App\Models\Incr;
use App\Models\Source;
use App\Models\Language;

class TitleController extends Controller
{
  public function __construct(){
      $this->middleware('lang');
      $this->middleware('auth');
  }

  public function index(){
    $langs = Language::all();
    $title = Vw_title::fromView()->get();
    return view('admin.title')->with(compact('title','langs'));
  }

  public function save(Request $request){
    $langs = Language::all();
    $title = Title::find(1);
    $def_title = "";
    $def_body = "";
// TITLE
    foreach($langs as $lang){
      $src = new Source;
      if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
        $def_title = $request->title[$lang->lang_key];
      }

      if(!empty($title->title)){
        $src = Source::byCode($title->title, $lang->lang_key)->first();
        if(empty($src)){
          $src = new Source;
          $src->code = $title->title;
        }
      }else{
        $incr_t = new Incr;
        $incr_t->value = 1;
        $incr_t->save();
        $src->code = $incr_t->id;
      }

      $src->kind = 'webtitle';
      $src->lang = $lang->lang_key;
      if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key])))
        $src->source = $request->title[$lang->lang_key];
      else
        $src->source = $def_title;

      $src->save();

      $title->title = $src->code;
      $title->save();
    }
// BODY
    foreach($langs as $lang){
      $src = new Source;
      if(!empty(preg_replace('/\s+/', '', $request->body[$lang->lang_key]))){
        $def_body = $request->body[$lang->lang_key];
      }

      if(!empty($title->body)){
        $src = Source::byCode($title->body, $lang->lang_key)->first();
        if(empty($src)){
          $src = new Source;
          $src->code = $title->body;
        }
      }else{
        $incr_t = new Incr;
        $incr_t->value = 1;
        $incr_t->save();
        $src->code = $incr_t->id;
      }

      $src->kind = 'webtitle';
      $src->lang = $lang->lang_key;
      if(!empty(preg_replace('/\s+/', '', $request->body[$lang->lang_key])))
        $src->source = $request->body[$lang->lang_key];
      else
        $src->source = $def_body;

      $src->save();

      $title->body = $src->code;
      $title->save();
    }


  return response()->json(['type' => 'success']);
}
}
