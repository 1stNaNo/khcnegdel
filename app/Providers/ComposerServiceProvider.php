<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'layouts.web.main_temp_top', 'App\Http\ViewComposers\MenuComposer'
        );

        View::composer(
            'layouts.web.slide_main', 'App\Http\ViewComposers\SliderComposer'
        );

        View::composer(
            'layouts.submain.sidebar', 'App\Http\ViewComposers\SidebarComposer'
        );

        View::composer(
            'layouts.submain.foot', 'App\Http\ViewComposers\FootComposer'
        );

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
