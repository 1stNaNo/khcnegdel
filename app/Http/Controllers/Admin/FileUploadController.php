<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Img;
use App\Models\ImgSeq;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class FileUPloadController extends Controller
{

    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    public function index($upload_type){

      return \View::make('admin.upload')->with('upload_type', $upload_type);
    }

    public function upload(Request $request){

        $imgSeq = new ImgSeq;
        $imgSeq->value = "img";
        $imgSeq->save();

        $fileName = time().$imgSeq->id.'.'.$request->file->getClientOriginalExtension();
        $request->file->move(base_path(trans('resource.conf.uploadPath').'basic'), $fileName);

        $img = new Img;
        $img->path = "/img/uploaded/basic/".$fileName;
        $img->name = $fileName;
        $img->type = "basic";
        $img->insert_date = \DB::raw('NOW()');

        $img->save();

        return [1, 2, 3];
    }

    public function uploadThumbnail(Request $request){

        $imgSeq = new ImgSeq;
        $imgSeq->value = "img";
        $imgSeq->save();

        $fileName = time().$imgSeq->id.'.'.$request->file->getClientOriginalExtension();
        // $request->file->move(public_path('img/uploaded/thumbnail'), $fileName);

        $path = base_path(trans('resource.conf.uploadPath').'thumbnail/' . $fileName);

        Image::make($request->file)->resize(1140, 511)->save($path);

        $img = new Img;
        $img->path = "/img/uploaded/thumbnail/".$fileName;
        $img->name = $fileName;
        $img->type = "thumbnail";
        $img->insert_date = \DB::raw('NOW()');

        $img->save();

        return [1, 2, 3];
    }

    public function uploadBanner(Request $request){

        $imgSeq = new ImgSeq;
        $imgSeq->value = "img";
        $imgSeq->save();

        $fileName = time().$imgSeq->id.'.'.$request->file->getClientOriginalExtension();
        // $request->file->move(public_path('img/uploaded/thumbnail'), $fileName);

        $path = public_path('img/uploaded/banner/' . $fileName);

        Image::make($request->file)->resize(728, 90)->save($path);

        $img = new Img;
        $img->path = "/img/uploaded/banner/".$fileName;
        $img->name = $fileName;
        $img->type = "banner";
        $img->insert_date = \DB::raw('NOW()');

        $img->save();

        return [1, 2, 3];
    }

    public function gallery($gType, Request $request){

      $imgs = Img::byType($gType)->get();

      if($request->type != "modal"){
        return \View::make('admin.gallery')->with('gType', $gType)->withModel($imgs);
      }else{
        return \View::make('admin.galleryajax')->with('gType', $gType)->withModel($imgs)->with("backType",$request->backtype)->with('input',$request->inputid);
      }
    }


}
