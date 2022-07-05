<?php

namespace App\Console;

use App\Services\WebDataService;
use Illuminate\Console\Command;

class WebDataCommand extends Command
{
    protected $action;
    protected $signature;

    /*
     * @var WebDataService
     */
    protected $webDataService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->webDataService = new WebDataService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('starting...');
        $queueName = $this->option('queue');
        $options = $this->options();

        $target = strtolower($this->argument('target'));

        if ($this->webDataService->performActionOnTarget($this->action, $target)) {
            $this->info('success!');
        } else {
            $this->newLine();
            $this->error('invalid arguments, take a look at the signature:');
            $this->info($this->signature);
            $this->newLine();
        }

        $this->info('finished!');
        return 0;
    }
}
