<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Models\Views\Vw_poll;
use App\Models\Views\Vw_answer;
use App\Models\Views\Vw_weblinks;

class SidebarComposer
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
      $poll = Vw_poll::fromView()->first();
      $answers = Vw_answer::fromView($poll->id)->get();
      $weblinks = Vw_weblinks::fromView()->get();
      return $view->with(compact('poll', 'answers', 'weblinks'));
    }
}
