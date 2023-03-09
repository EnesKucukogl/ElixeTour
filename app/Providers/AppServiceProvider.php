<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use View;
use App\Models\Menu;
use App\Models\Config;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.partials.language_switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });


        $menuItems = Menu::where("visible", '=', "1", "and")->where('upper_menu_id', '=', '0')->orderBy('sort_order')->get();
        view()->share('menuItems', $menuItems);

        $config = Config::where("Id", '=', "1")->first();
        view()->share('config', $config);

    }
}
