<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Views\Vw_filetype;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Language;
use App\Models\FileType;
use App\Models\Source;
use App\Models\Incr;

class FileTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){

      return \View::make('admin.filetype');
    }

    public function anyData()
    {
      return Datatables::of(Vw_filetype::fromView())->make(true);
    }

    public function indexA(Request $request){

      $langs = Language::all();

      $source = collect([]);

      $vw_filetype = null;

      if($request->isEdit && !empty($request->id)){

          foreach($langs as $lang){
            $vwfiletype = Vw_filetype::equalListByIdLang($lang->lang_key, $request->id)->first();

            if(count($vwfiletype) > 0){
              $vw_filetype = $vwfiletype;
            }

            $source->put($lang->lang_key, $vwfiletype);
          }
      }

        return \View::make('admin.filetype_action')->with(compact('langs'))->with(compact('source'))->with(compact('vw_filetype'));
    }

    public function save(Request $request){

      $filetype = new FileType;

      // SOURCES PACK
      $langs = Language::all();
      $lcl_title = "";

      $validate = [];
      $validate["title.".$langs[0]->lang_key] = "required";
      $validate["icon"] = "required";

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{
        foreach($langs as $lang){
            if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                $lcl_title = $request->title[$lang->lang_key];
            }
        }

        if(!empty($request->id)){

            $filetype = FileType::find($request->id);

            foreach($langs as $lang){
                $t_source = Source::byCode($filetype->title_sid, $lang->lang_key)->first();

                if(count($t_source) <= 0){
                  $t_source = new Source;
                  $t_source->code = $filetype->title_sid;
                  $t_source->lang = $lang->lang_key;
                  $t_source->kind = 'filetype';
                }

                if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                    $t_source->source = $request->title[$lang->lang_key];
                }else{
                    $t_source->source = $lcl_title;
                }

                $t_source->save();
            }

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
                $t_source->kind = 'filetype';
                $t_source->save();

                $t_source =  new Source;

            }

            $filetype->title_sid = $incr_t->id;

        }

        // BASIC pack
        $filetype->icon = $request->icon;
        $filetype->active_flag = $request->active_flag;

        $filetype->save();

        return response()->json(['type' => 'success']);
      }

    }

    public function edit()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function remove(Request $request){

      $filetype = FileType::find($request->id);
      Source::deleteByCode($filetype->title_sid);
      $filetype->delete();

      return response()->json(['type' => 'success']);
    }

}
