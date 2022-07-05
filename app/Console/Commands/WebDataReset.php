<?php

namespace App\Console\Commands;

use App\Console\WebDataCommand;

class WebDataReset extends WebDataCommand
{
    protected $action = 'reset';
    protected $signature = 'webdata:reset
        {target : [soft or hard]}
        {--Q|queue : Whether the job should be queued}';
    protected $description = 'reset [soft or hard]';

    public function __construct()
    {
        parent::__construct();
    }

}
