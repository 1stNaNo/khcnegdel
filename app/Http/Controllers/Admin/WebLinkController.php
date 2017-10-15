<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Views\Vw_weblinks;
use App\Models\Weblink;
use App\Models\Language;
use App\Models\Incr;
use App\Models\Source;
use App\Models\ImgSeq;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Datatables;
use Validator;
class WebLinkController extends Controller
{
	public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }
    public function index(){
		return view('admin.weblink_list');
    }

    public function weblinkList(){
    	return Datatables::of(Vw_weblinks::fromView())->make(true);
    }

    public function register(Request $request){

    	$langs = Language::all();

			$source = collect([]);

			$weblinks = null;

    	if($request->isEdit && !empty($request->id)){

				foreach($langs as $lang){
						$wblinks = Vw_weblinks::where('id', $request->id)->where('lang', $lang->lang_key)->first();

						if(count($wblinks) > 0){
							$weblinks = $wblinks;
						}

						$source->put($lang->lang_key, $wblinks);
				}

    	}
    	return view('admin.weblink')->with(compact('langs'))->with(compact('source'))->with(compact('weblinks'));
    }

    public function save(Request $request){

			$weblink = new Weblink;

			// SOURCES PACK
			$langs = Language::all();
			$lcl_title = "";

			$validate = [];
			$validate["title.".$langs[0]->lang_key] = "required";
			$validate["link"] = "required";

			$validator = \Validator::make($request->all(), $validate);

			if($validator->fails()){
				return response()->json($validator->messages(), 200);
			}else{

				if(count($request->img) > 0){
					$imgSeq = new ImgSeq;
	        $imgSeq->value = "img";
	        $imgSeq->save();

	        $fileName = time().$imgSeq->id.'.'.$request->img->getClientOriginalExtension();
	        // $request->file->move(public_path('img/uploaded/thumbnail'), $fileName);

	        $path = base_path(trans('resource.conf.uploadPath').'links/' . $fileName);

	        Image::make($request->img)->resize(115, 85)->save($path);
				}

				foreach($langs as $lang){
						if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
								$lcl_title = $request->title[$lang->lang_key];
						}
				}

				if(!empty($request->id)){

						$weblink = Weblink::find($request->id);

						foreach($langs as $lang){
								$t_source = Source::byCode($weblink->title, $lang->lang_key)->first();

								if(count($t_source) <= 0){
									$t_source = new Source;
									$t_source->code = $weblink->title;
									$t_source->lang = $lang->lang_key;
									$t_source->kind = 'weblink';
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
								$t_source->kind = 'weblink';
								$t_source->save();

								$t_source =  new Source;

						}

						$weblink->title = $incr_t->id;
				}

				// BASIC pack

				$weblink->category_id = $request->category_id;
				$weblink->link = $request->link;
				if(count($request->img) > 0){
					$weblink->img = trans('resource.conf.readPath')."links/".$fileName;
				}else{
					$weblink->img = $request->img_hidden;
				}

				$weblink->save();

				return response()->json(['type' => 'success']);
    	}
		}

    public function delete(Request $request){

    	$weblink = Weblink::find($request->id);
    	Source::deleteByCode($weblink->title);
    	$weblink->delete();

			return response()->json(['type' => 'success']);
    }
}
