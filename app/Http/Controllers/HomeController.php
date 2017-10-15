<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Views\Vw_news;
use App\Models\Views\Vw_weblinks;
use App\Models\Views\Vw_poll;
use App\Models\Views\Vw_answer;

use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('lang');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $news = Vw_news::latestNews()->paginate(9);
      $viewnews = Vw_news::mostViewed()->get();
      $commentnews = Vw_news::mostComment()->get();
      $weblinks = Vw_weblinks::fromView()->get();
      $poll = Vw_poll::fromView()->first();
      $answers = Vw_answer::fromView($poll->id)->get();
      return \View::make('index')->with(compact('news', 'viewnews', 'commentnews','weblinks','poll','answers'));
    }
}
