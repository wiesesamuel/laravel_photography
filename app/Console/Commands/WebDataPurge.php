<?php

namespace App\Console\Commands;

use App\Console\WebDataCommand;

class WebDataPurge extends WebDataCommand
{
    protected $action = 'purge';
    protected $signature = 'webdata:purge
        {target : [config, thumbnail]}
        {--Q|queue : Whether the job should be queued}';
    protected $description = 'purge [config, thumbnail]';

    public function __construct()
    {
        parent::__construct();
    }
}
