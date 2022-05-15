<?php

namespace Performing\Taskday\Timer;

use Illuminate\Support\Facades\Event;
use Taskday\Facades\Taskday;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Taskday\Events\CardCreatedEvent;
use Taskday\Models\Card;

class TimerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Register plugin
        Taskday::register(new TimerPlugin, 'timer');

        // Registering extra web routes
        Route::middleware('web')->group(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
