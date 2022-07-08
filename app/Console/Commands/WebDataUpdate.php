<?php

namespace App\Console\Commands;

use App\Console\WebDataCommand;

class WebDataUpdate extends WebDataCommand
{
    protected $action = 'update';
    protected $signature = 'webdata:update
        {target : [artists = artists:soft, artists:hard]}
        {--Q|queue : Whether the job should be queued}';
    protected $description = 'update [artists = artists:soft, artists:hard]';

    public function __construct()
    {
        parent::__construct();
    }
}
