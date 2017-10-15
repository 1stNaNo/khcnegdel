<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Views\Vw_shorter;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Language;
use App\Models\Shorter;
use App\Models\Source;
use App\Models\Incr;

class ShorterController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){

      return \View::make('admin.shorter');
    }

    public function anyData()
    {
      return Datatables::of(Vw_shorter::fromView())->make(true);
    }

    public function indexA(Request $request){

      $langs = Language::all();

      $source = collect([]);

      $vw_shorter = null;

      if(!empty($request->id)){
        foreach($langs as $lang){
          $vw_shorter = Vw_shorter::equalListByIdLang($lang->lang_key, $request->id)->first();
          $source->put($lang->lang_key, $vw_shorter);
        }
      }
      return \View::make('admin.shorter_action')->with(compact('langs'))->with(compact('source'))->with(compact('vw_shorter'));
    }

    public function save(Request $request){

      $shorter = new Shorter;

      // SOURCES PACK
      $langs = Language::all();
      $lcl_title = "";

      foreach($langs as $lang){
          if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
              $lcl_title = $request->title[$lang->lang_key];
          }
      }

      if(!empty($request->id)){

          $shorter = Shorter::find($request->id);

          foreach($langs as $lang){
              $t_source = Source::byCode($shorter->content_sid, $lang->lang_key)->first();

              if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                  $t_source->source = $request->title[$lang->lang_key];
              }else{
                  $t_source->source = $lcl_title;
              }

              $t_source->save();
          }

          $shorter->update_user = \Auth::user()->user_id;
          $shorter->update_date = \DB::raw('NOW()');

      }else{
          $incr_t = new Incr;
          $incr_t->value = 1;
          $incr_t->save();

          foreach($langs as $lang){

              $t_source =  new Source;

              if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                    $t_source->source = $request->title[$lang->lang_key];
              }else{
                    $t_source->source = $lcl_title;
              }

              $t_source->code = $incr_t->id;
              $t_source->lang = $lang->lang_key;
              $t_source->kind = 'shorter';
              $t_source->save();

              $t_source =  new Source;

          }

          $shorter->content_sid = $incr_t->id;

          $shorter->insert_user = \Auth::user()->user_id;
          $shorter->insert_date = \DB::raw('NOW()');
      }

      // BASIC pack

      $shorter->url = $request->link;
      $shorter->active_flag = 1;
      $shorter->target = $request->target;
      $shorter->show = $request->show;

      $shorter->save();

      return response()->json(['type' => 'success']);
    }

    public function edit()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function remove(Request $request){

      $shorter = Shorter::find($request->id);
      $shorter->delete();

      return response()->json(['type' => 'success']);
    }

}
