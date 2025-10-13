<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Force HTTPS in production
        if (App::environment('production') || 
            config('app.force_https') === true ||
            env('FORCE_HTTPS', false)) {
            
            URL::forceScheme('https');
            
            // Trust proxies jika menggunakan load balancer
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }
}
