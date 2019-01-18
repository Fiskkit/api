<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 9/1/19
 * Time: 5:16 PM
 */

namespace App\Providers;


use App\Fractal\Manager\fractalManager;
use App\Manager\ArticleManager;
use App\Manager\LoginManager;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->defineResources();
        //$this->registerValidator();
        $this->registerMiddleware();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerService();
    }

    public function registerService()
    {
        $this->app->singleton('fiskkit.manager.article_manager', function () {
            return new ArticleManager();
        });

        $this->app->singleton('fiskkit.fractal.manager.fractal_manager', function () {
            return new fractalManager();
        });

        $this->app->singleton('fiskkit.manager.login_manager', function () {
            return new LoginManager();
        });
    }

    public function registerValidator()
    {
        //Validator::extend('is_valid_social_data', SocialDataValidator::class . '@handle');
    }

    protected function defineResources()
    {
        //
    }

    private function registerMiddleware()
    {
        //
    }

}