<?php
namespace mawdoo3\laravelTask;

use Illuminate\Console\Command;

class TaskInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'initial install of Custom Search';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        echo PHP_EOL;
        exec("cp __DIR__ /Migration database/migrations/TaskInstall");
        $this->line(PHP_EOL."<info>Coping:</info> Migration Done");

        \Artisan::call('migrate path=database/migrations/TaskInstall');
        $this->line(PHP_EOL."<info>Migrating:</info> Migrating DB Done");
        \Artisan::call("vendor:publish --provider='mawdoo3\laravelTask\TaskServiceProvider'");
        $this->line(PHP_EOL."<info>Publishing:</info> Publishing Configration Done");

        $this->line(PHP_EOL."<info>All Done !!</info>");
    }
}
