<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Views\Vw_category;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Language;
use App\Models\Category;
use App\Models\Source;
use App\Models\Incr;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){

      return \View::make('admin.category');
    }

    public function anyData()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function indexA(Request $request){

      $langs = Language::all();

      $source = collect([]);

      $vw_category = null;

      $category = Vw_category::fromView()->get();

      if($request->isEdit && !empty($request->id)){

          foreach($langs as $lang){
            $vwcategory = Vw_category::equalListByIdLang($lang->lang_key, $request->id)->first();

            if(count($vwcategory) > 0){
              $vw_category = $vwcategory;
            }

            $source->put($lang->lang_key, $vwcategory);
          }
      }

        return \View::make('admin.category_action')->with(compact('langs'))->with(compact('source'))->with(compact('vw_category'))->with('edit', $request->isEdit)->with(compact('category'));
    }

    public function save(Request $request){

      $category = new Category;

      // SOURCES PACK
      $langs = Language::all();
      $lcl_title = "";

      $validate = [];
      $validate["title.".$langs[0]->lang_key] = "required";

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

            $category = Category::find($request->id);

            foreach($langs as $lang){
                $t_source = Source::byCode($category->title_sid, $lang->lang_key)->first();

                if(count($t_source) <= 0){
                  $t_source = new Source;
                  $t_source->code = $category->title_sid;
                  $t_source->lang = $lang->lang_key;
                  $t_source->kind = 'category';
                }

                if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                    $t_source->source = $request->title[$lang->lang_key];
                }else{
                    $t_source->source = $lcl_title;
                }

                $t_source->save();
            }

            $category->update_user = \Auth::user()->user_id;
            $category->update_date = \DB::raw('NOW()');

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
                $t_source->kind = 'category';
                $t_source->save();

                $t_source =  new Source;

            }

            $category->title_sid = $incr_t->id;

            $category->insert_user = \Auth::user()->user_id;
            $category->insert_date = \DB::raw('NOW()');
            $category->active_flag = 1;
        }

        // BASIC pack

        $category->parent_id = $request->parent;
        $category->url = $request->link;
        $category->active_flag = $request->active;
        $category->target = $request->target;
        $category->order_num = $request->order_num;

        if($request->showmenu != null){
            $category->show_menu = 1;
        }else{
          $category->show_menu = 0;
        }

        $category->save();

        return response()->json(['type' => 'success']);
      }

    }

    public function edit()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function remove(Request $request){

      $category = Category::find($request->id);
      Source::deleteByCode($category->title_sid);
      $category->delete();

      return response()->json(['type' => 'success']);
    }

}
