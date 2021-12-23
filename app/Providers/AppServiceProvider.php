<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;//全ページ共通変数用
use Carbon\Carbon;//カーボン使用

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
        View::composer('*', function($view) {
            // 共通変数
            $year = (new Carbon())->format('Y');
            $view->with('year', $year);
        });
    }
}
