<?php

namespace App\Providers;

use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class PetugasAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Auth::extend('petugas', function ($app, $name, array $config) {
            $petugas = new SessionGuard($name, Auth::createUserProvider($config['provider']), $app['session.store']);

            $petugas->setCookieJar($app['cookie']);
            $petugas->setDispatcher($app['events']);
            $petugas->setRequest($app->refresh('request', $petugas, 'setRequest'));

            return $petugas;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
