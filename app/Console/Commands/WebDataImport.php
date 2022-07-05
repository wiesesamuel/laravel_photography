<?php

namespace App\Console\Commands;

use App\Console\WebDataCommand;

class WebDataImport extends WebDataCommand
{
    protected $action = 'import';
    protected $signature = 'webdata:import
        {target : [all, config, artist]}
        {--Q|queue : Whether the job should be queued}';
    protected $description = 'import [all, config, artist]';

    public function __construct()
    {
        parent::__construct();
    }
}
