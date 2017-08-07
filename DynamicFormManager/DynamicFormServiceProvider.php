<?php
namespace App\Libraries\DynamicFormManager;

use Illuminate\Support\ServiceProvider;

class DynamicFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'DynamicForm');
        $this->app->singleton('DynamicForm', function ($app){
            return new DynamicFormService();
        });
    }
}

