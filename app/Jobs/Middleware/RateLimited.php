<?php

namespace App\Jobs\Middleware;

use Illuminate\Support\Facades\Redis;

class RateLimited
{
    private $jobBreakDuration;

    /**
     * RateLimited constructor.
     * @param int $jobBreakDuration
     */
    public function __construct(int $jobBreakDuration = 60)
    {
        $this->jobBreakDuration = $jobBreakDuration;
    }


    /**
     * Process the queued job.
     *
     * @param mixed $job
     * @param callable $next
     * @return mixed
     */
    public function handle($job, $next)
    {
        Redis::throttle('key')
            ->block(0)->allow(1)->every($this->jobBreakDuration)
            ->then(function () use ($job, $next) {
                // Lock obtained...

                $next($job);
            }, function () use ($job) {
                // Could not obtain lock...

                $job->release($this->jobBreakDuration);
            });
    }
}
