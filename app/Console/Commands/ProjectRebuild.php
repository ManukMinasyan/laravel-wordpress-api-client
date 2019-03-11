<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectRebuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:rebuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project Rebuild!';

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
        //
    }
}
