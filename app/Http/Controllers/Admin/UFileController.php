<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Views\Vw_ufile;
use App\Models\Views\Vw_filetype;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Language;
use App\Models\Ufile;
use App\Models\Source;
use App\Models\Incr;
use App\Models\ImgSeq;
use Intervention\Image\Facades\Image;

class UFileController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){

      return \View::make('admin.ufile');
    }

    public function anyData()
    {
      return Datatables::of(Vw_ufile::fromView())->make(true);
    }

    public function indexA(Request $request){

      $langs = Language::all();

      $source = collect([]);

      $vw_ufile = null;

      $vw_filetype = Vw_filetype::fromView()->get();

      if($request->isEdit && !empty($request->id)){

          foreach($langs as $lang){
            $vwufile = Vw_ufile::equalListByIdLang($lang->lang_key, $request->id)->first();

            if(count($vwufile) > 0){
              $vw_ufile = $vwufile;
            }

            $source->put($lang->lang_key, $vwufile);
          }
      }

        return \View::make('admin.ufile_action')->with(compact('langs'))->with(compact('source'))->with(compact('vw_ufile'))->with(compact('vw_filetype'));
    }

    public function save(Request $request){

      $ufile = new Ufile;

      // SOURCES PACK
      $langs = Language::all();
      $lcl_title = "";

      $validate = [];
      $validate["name.".$langs[0]->lang_key] = "required";
      $validate["confirm_date"] = "required";
      $validate["number"] = "required";


      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{

        if(count($request->img) > 0){
					$imgSeq = new ImgSeq;
	        $imgSeq->value = "img";
	        $imgSeq->save();

	        $fileName = time().$imgSeq->id.'.'.$request->img->getClientOriginalExtension();
	        $request->img->move(base_path(trans('resource.conf.uploadPath')).'files' , $fileName);

				}

        foreach($langs as $lang){
            if(!empty(preg_replace('/\s+/', '', $request->name[$lang->lang_key]))){
                $lcl_title = $request->name[$lang->lang_key];
            }
        }

        if(!empty($request->id)){

            $ufile = Ufile::find($request->id);

            foreach($langs as $lang){
                $t_source = Source::byCode($ufile->name_sid, $lang->lang_key)->first();

                if(count($t_source) <= 0){
                  $t_source = new Source;
                  $t_source->code = $ufile->name_sid;
                  $t_source->lang = $lang->lang_key;
                  $t_source->kind = 'file';
                }

                if(!empty(preg_replace('/\s+/', '', $request->name[$lang->lang_key]))){
                    $t_source->source = $request->name[$lang->lang_key];
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

                if(!empty(preg_replace('/\s+/', '', $request->name[$lang->lang_key]))){
                      $t_source->source = $request->name[$lang->lang_key];
                }else{
                      $t_source->source = $lcl_title;
                }

                $t_source->code = $incr_t->id;
                $t_source->lang = $lang->lang_key;
                $t_source->kind = 'file';
                $t_source->save();

                $t_source =  new Source;

            }

            $ufile->name_sid = $incr_t->id;
        }

        // BASIC pack

        $ufile->type_id = $request->type_id;
        $ufile->number = $request->number;
        $ufile->confirm_date = $request->confirm_date;

        if(count($request->img) > 0){
					$ufile->path = trans('resource.conf.readPath')."files/".$fileName;
				}else{
					$ufile->path = $request->img_hidden;
				}


        $ufile->save();

        return response()->json(['type' => 'success']);
      }

    }

    public function edit()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function remove(Request $request){

      $ufile = Ufile::find($request->id);
      Source::deleteByCode($ufile->name_sid);
      $ufile->delete();

      return response()->json(['type' => 'success']);
    }

}
