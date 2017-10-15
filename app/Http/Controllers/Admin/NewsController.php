<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Views\Vw_news;
use App\Models\News;
use App\Models\Source;
use App\Models\Incr;
use App\Models\NewsCat;
use App\Models\Views\Vw_category;
use App\Models\Language;
use App\Http\Controllers\Controller;
use Datatables;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){

      return \View::make('admin.news');
    }


    public function anyData()
    {
      return Datatables::of(Vw_news::fromViewByUserId())->make(true);
    }

    public function indexA(Request $request){

        $langs = Language::all();

        $source = collect([]);

        $vw_news = null;
        $newscat = null;

        $category = Vw_category::fromView()->get();

        if($request->isEdit && !empty($request->id)){

            $newscat = NewsCat::byNewsId($request->id)->first();

            foreach($langs as $lang){
              $vwnews = Vw_news::byIdAndLang($request->id, $lang->lang_key)->first();

              if(count($vwnews) > 0){
                  $vw_news = $vwnews;
              }

              $source->put($lang->lang_key, $vwnews);
            }
        }

        return \View::make('admin.news_action')->with(compact('langs'))->with(compact('source'))->with(compact('vw_news'))->with('edit', $request->isEdit)->with(compact('category'))->with(compact('newscat'));
    }

    public function save(Request $request){

      $news = new News;

      // SOURCES PACK
      $langs = Language::all();
      $lcl_title = "";
      $lcl_content = "";

      $validate = [];
      $validate["title.".$langs[0]->lang_key] = "required";
      $validate["content.".$langs[0]->lang_key] = "required";
      $validate["thumbnail"] = "required";

      $validator = \Validator::make($request->all(), $validate);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{

        foreach($langs as $lang){
            if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                $lcl_title = $request->title[$lang->lang_key];
            }

            if(!empty(preg_replace('/\s+/', '', $request->content[$lang->lang_key]))){
                $lcl_content = $request->content[$lang->lang_key];
            }
        }

        $incr_t = null;
        $incr_c = null;

        if(!empty($request->id)){

            $news = News::find($request->id);

            foreach($langs as $lang){
                $t_source = Source::byCode($news->title_sid, $lang->lang_key)->first();
                $c_source = Source::byCode($news->content_sid, $lang->lang_key)->first();

                if(count($t_source) <= 0){
                  $t_source = new Source;
                  $t_source->code = $news->title_sid;
                  $t_source->lang = $lang->lang_key;
                  $t_source->kind = 'title';
                }

                if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                    $t_source->source = $request->title[$lang->lang_key];
                }else{
                    $t_source->source = $lcl_title;
                }

                $t_source->save();

                if(count($c_source) <= 0){
                  $c_source = new Source;
                  $c_source->code = $news->content_sid;
                  $c_source->lang = $lang->lang_key;
                  $c_source->kind = 'news';
                }

                if(!empty(preg_replace('/\s+/', '', $request->content[$lang->lang_key]))){
                      $c_source->source = $request->content[$lang->lang_key];
                }else{
                      $c_source->source = $lcl_content;
                }

                $c_source->save();
            }

            $news->update_user = \Auth::user()->user_id;
            $news->update_date = \DB::raw('NOW()');

        }else{
            $incr_t = new Incr;
            $incr_t->value = 1;
            $incr_t->save();

            $incr_c = new Incr;
            $incr_c->value = 1;
            $incr_c->save();

            foreach($langs as $lang){

                $t_source =  new Source;

                if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
                      $t_source->source = $request->title[$lang->lang_key];
                }else{
                      $t_source->source = $lcl_title;
                }

                $t_source->code = $incr_t->id;
                $t_source->lang = $lang->lang_key;
                $t_source->kind = 'title';
                $t_source->save();

                $t_source =  new Source;

                if(!empty(preg_replace('/\s+/', '', $request->content[$lang->lang_key]))){
                      $t_source->source = $request->content[$lang->lang_key];
                }else{
                      $t_source->source = $lcl_content;
                }

                $t_source->code = $incr_c->id;
                $t_source->lang = $lang->lang_key;
                $t_source->kind = 'news';
                $t_source->save();
            }

            $news->title_sid = $incr_t->id;
            $news->content_sid = $incr_c->id;

            $news->insert_user = \Auth::user()->user_id;
            $news->insert_date = \DB::raw('NOW()');
            $news->views = 0;
        }

        // BASIC pack

        $news->thumbnail = $request->thumbnail;
        $news->have_comment = 1;
        $news->active_flag = 1;

        if($request->slide != null){
            $news->slide = 1;
        }else{
          $news->slide = 0;
        }

        $news->save();

        NewsCat::deleteByNewsId($news->id);

        $newscat = new NewsCat;
        $newscat->news_id = $news->id;
        $newscat->cat_id = $request->category;

        $newscat->save();


        return response()->json(['type' => 'success']);
      }
    }

    public function edit()
    {
      return Datatables::of(Vw_category::fromView())->make(true);
    }

    public function remove(Request $request){

        $news = News::find($request->id);

        NewsCat::deleteByNewsId($news->id);
        Source::deleteByCode($news->title_sid);
        Source::deleteByCode($news->content_sid);

        $news->delete();

        return response()->json(['type' => 'success']);

    }

}
