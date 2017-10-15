<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Views\Vw_category;
use App\Models\ContentCat;

class NewsCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){
    	$categories = Vw_category::fromView()->get();
    	$contentcats = ContentCat::all();
    	return view('admin.newscat')->with(compact('categories'))->with(compact('contentcats'));
    }

    public function save(Request $request){
    	foreach ($request->contentid as $contentid) {
    		$concat = ContentCat::find($contentid);
    		$concat->cat_id = $request->categoryid[$contentid];
    		$concat->save();
    	}

    	return response()->json(['type' => 'success']);
    }

}
