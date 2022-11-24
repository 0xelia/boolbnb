<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useTailwind();

        //singleton
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                    [
                        'environment' =>'sandbox',
                        'merchantId' => '6thm2yxvhq57thys',
                        'publicKey' => 'j92jbq953vjt3r4w',
                        'privateKey' => '0d4514468bf3f84e041f96f0a79d891c'
                    ]
            );
        });
    }
}
