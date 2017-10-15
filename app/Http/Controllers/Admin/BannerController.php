<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\ImgSeq;
use Datatables;
use Validator;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index(){
    	return view('admin.banner');
    }

    public function anyData()
    {
      return Datatables::of(Banner::all())->make(true);
    }

    public function indexA(Request $request){

        $banner = Banner::find($request->id);

        return \View::make('admin.banner_action')->with(compact('banner'));
    }

    public function save(Request $request){

      $banner = new Banner;

      if(count($request->img) > 0){
         $imgSeq = new ImgSeq;
         $imgSeq->value = "img";
         $imgSeq->save();

         $fileName = time().$imgSeq->id.'.'.$request->img->getClientOriginalExtension();
         // $request->file->move(public_path('img/uploaded/thumbnail'), $fileName);

         $path = base_path(trans('resource.conf.uploadPath').'banner/' . $fileName);

         Image::make($request->img)->resize(1300, 360)->save($path);
       }

       if(!empty($request->id)){

         $banner = Banner::find($request->id);

       }

       if(count($request->img) > 0){
  				$banner->value = trans('resource.conf.readPath')."banner/".$fileName;
  		 }else{
  				$banner->value = $request->img_hidden;
  		 }

       $banner->save();

       return response()->json(['type' => 'success']);
    }

    public function remove(Request $request){
        $banner = Banner::find($request->id);
        $banner->delete();

        return response()->json(['type' => 'success']);
    }
}
