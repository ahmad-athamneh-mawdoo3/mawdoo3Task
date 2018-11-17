<?php
namespace mawdoo3\laravelTask;

use Illuminate\Support\ServiceProvider;
use mawdoo3\laravelTask\TaskInstall;

class TaskServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'task');
        $this->loadMigrationsFrom(__DIR__ . '/Migration');
        $this->publishes([
            __DIR__ . '/Config/customSearch.php' => config_path('customSearch.php'),
        ]);
        if ($this->app->runningInConsole()) {
            $this->commands([TaskInstall::class]);
        }

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
