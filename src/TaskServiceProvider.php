<?php
namespace mawdoo3\laravelTask;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'task');
        $this->loadMigrationsFrom(__DIR__.'/Migration');
        $this->publishes([
            __DIR__.'/Config/customSearch.php' => config_path('customSearch.php'),
        ]);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}