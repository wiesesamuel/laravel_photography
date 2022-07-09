<?php

namespace App\Jobs;

use App\Helper\InstagramHelper;
use App\Models\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CollectArtistInstagramData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Carbon
     */
    private static $nextTimeSlot;
    public $releaseTimeShift = 3600 / 4;
    public $tries = 25;

    /**
     * @var Artist
     */
    public $artist;

    /**
     * @var InstagramHelper
     */
    public $instagramHelper;

    public $callbackFunction;

    public function __construct(Artist $artist, string $callbackFunction = null)
    {
        $this->artist = $artist;
        $this->instagramHelper = new InstagramHelper();
        $this->callbackFunction = $callbackFunction;
    }

    public function handle()
    {
        $run = true;

        // dont even try if somebody else failed
        if (isset(self::$nextTimeSlot) && self::$nextTimeSlot->gt(Carbon::now())) {
            Log::channel('job')->info("PRE-RESCHEDULE Job for artist " . $this->artist->id);
            $this->release(self::$nextTimeSlot->diffInSeconds(Carbon::now()) + 5);
            $run = false;
        }

        if ($run) {
            Log::channel('job')->info("TRY Job Queue for artist " . $this->artist->id);
            $result = $this->instagramHelper->getInstagramInfoOrFalse($this->artist->instagram_url);

            if ($result === false) {
                // failed
                $this->failed();

            } else {
                // success
                $this->artist->instagram_data = $result;
                $this->artist->saveAndCache();
                self::$nextTimeSlot = null;
                Log::channel('job')->info("SUCCESS Job Queue for artist " . $this->artist->id);
            }

            Log::channel('job')->info("END Job Queue for artist " . $this->artist->id);
        }
    }

    public function failed()
    {
        if ($this->releaseTimeShift < 604800) {
            Log::channel('job')->info("RESCHEDULE Job for artist " . $this->artist->id);
            $this->releaseTimeShift *= 2;
            self::$nextTimeSlot = Carbon::now()->addSeconds($this->releaseTimeShift);
            $this->release($this->releaseTimeShift + 5);
        } else {
            Log::channel('job')->info("CANCEL Job for artist " . $this->artist->id);
        }
    }


    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     * public function middleware()
     * {
     * return [new RateLimited];
     * }
     */
}
