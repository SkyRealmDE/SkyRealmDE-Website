<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

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
    public function boot( UrlGenerator $url, Request $request)
    {

        if ($request->server->get('HTTP_X_FORWARDED_PROTO') == 'https') {
            $url->forceScheme('https');
        }

    }
}
