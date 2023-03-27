<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
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
    public function boot(UrlGenerator $url, Request $request): void
    {
        if ($request->server->get('HTTP_X_FORWARDED_PROTO') == 'https') {
            $url->forceScheme('https');
        }

        view()->composer('*', function ($view) {
            $currentOrNextEvent = Event::where('end_date', '>=', now())
                ->orderBy('start_date', 'asc')
                ->first();
            $view->with('currentOrNextEvent', $currentOrNextEvent);
        });

    }
}
