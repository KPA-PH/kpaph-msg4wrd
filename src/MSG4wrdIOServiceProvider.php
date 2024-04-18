<?php

namespace KPAPH\MSG4wrdIO;

use Illuminate\Support\ServiceProvider;

class MSG4wrdIOServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'msg4wrd-io');
        $this->mergeConfigFrom(
            __DIR__ . '/config/msg4wrdio.php',
            'msg4wrdio'
        );
        $this->publishes([
            __DIR__ . '/config/msg4wrdio.php' => config_path('msg4wrdio.php'),
        ]);
    }

    public function register()
    {
        $this->app->make('KPAPH\MSG4wrdIO\Http\Controllers\SampleController');
    }
}
