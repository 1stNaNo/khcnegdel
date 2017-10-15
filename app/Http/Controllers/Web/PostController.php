<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Views\Vw_news;
use App\Models\Views\Vw_category;
use App\Models\Comment;
use App\Models\Answer;
use App\Models\Views\Vw_answer;
use Session;

class PostController extends Controller
{
  public function __construct(){
  }

  public function postbycategory(Request $request){
    $news = Vw_news::byCategoryList($request->id)->orderBy('insert_date', 'desc')->paginate(5);
    $category = Vw_category::equalListById($request->id)->first();

    return view('web.postbycategory')->with(compact('news', 'category'));
  }

  public function post(Request $request){
    $news = Vw_news::byId($request->id)->first();
    $comments = Comment::byPostId($request->id)->get();
    return view('web.post')->with(compact('news', 'comments'));
  }

  public function savecomment(Request $request){
    $c = new Comment;
    $c->name = $request->name;
    $c->comment = $request->comment;
    $c->post_id = $request->post_id;
    $c->insert_date = \Carbon\Carbon::now();
    $c->save();
    return redirect()->to("/post/".$request->post_id);
  }

  public function submitpoll(Request $request){
    $answer = Answer::find($request->answer_id);
    $answer->total = ($answer->total) + 1;
    $answer->save();
    Session::put('poll', true);

    return Vw_answer::where('poll_id', $request->poll_id)->where('lang', Session::get('lang'))->get();
  }

}
