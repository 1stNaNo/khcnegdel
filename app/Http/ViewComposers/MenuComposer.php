<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Models\Views\Vw_category;
use App\Models\Views\Vw_title;
use App\Models\Language;
use App\Models\Sys\SysInterval;
use App\Models\Sys\SysClient;
use Session;
use Auth;
class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
      $vw_title = Vw_title::where("lang", Session::get('lang'))->first();
      $cur_lang = Language::where('lang_key', Session::get('lang'))->first();
      $langs = Language::all();
      $categories = Vw_category::fromViewShowed()->orderBy('parent_id')->orderBy('order_num', 'asc');
      if(Auth::check())
        $client = SysClient::find(Auth::user()->org_id);

      return $view->with(compact('categories', 'langs', 'cur_lang', 'client', 'isActive','vw_title'));
    }
}
