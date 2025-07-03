<?php

namespace App\Providers;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $menus = Menu::whereNull('parent_id')->with('children.children')->orderBy('order')->get();
            $view->with('menus', $menus);
        });
    }

    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\LogLastUserLogin::class,
        ],
    ];
}
