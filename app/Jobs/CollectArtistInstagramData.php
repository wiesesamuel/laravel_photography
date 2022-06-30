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
use PHPUnit\Framework\Exception;

class CollectArtistInstagramData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Carbon
     */
    private static $nextTimeSlot;
    public $releaseTimeShift = 30;
    public $tries = 25;
    /**
     * @var Artist
     */
    public $artist;
    /**
     * @var InstagramHelper
     */
    public $instgramHelper;

    public $callbackFunction;

    public function __construct(Artist $artist, string $callbackFunction = null)
    {
        $this->artist = $artist;
        $this->instgramHelper = new InstagramHelper();
        $this->callbackFunction = $callbackFunction;
    }

    public function handle()
    {
//            $this->release(10);
//            Log::channel('job')->info("TRY Job for artist " . $this->artist->id);

        // dont even try if somebody else failed
        if (self::$nextTimeSlot && self::$nextTimeSlot->gt(Carbon::now())) {
            $this->release(self::$nextTimeSlot->diffInSeconds(Carbon::now()));
        }

        try {
            Log::channel('job')->info("TRY Job Queue for artist " . $this->artist->id);
            $result = $this->instgramHelper->getInstagramInfoOrFail($this->artist->instagram_url);
            $this->artist->instagram_data = $result;
            $this->artist->save();
            self::$nextTimeSlot = null;

            if (isset($this->callbackFunction)) {
                try {
                    call_user_func($this->callbackFunction, $this->artist);
                } catch (Exception $e) {
                    Log::channel('job')->info("CALLBACK FAILED in Job Queue for artist " . $this->artist->id);
                }
            }

        } catch (Exception $e) {
            Log::channel('job')->info("FAILED Job for artist " . $this->artist->id);
            self::$nextTimeSlot = Carbon::now()->addSeconds($this->releaseTimeShift);
            if ($this->releaseTimeShift < 604800) {
                Log::channel('job')->info("RESCHEDULE Job for artist " . $this->artist->id);
                $this->releaseTimeShift *= 2;
                $this->release(self::$nextTimeSlot->diffInSeconds(Carbon::now()));
            } else {
                Log::channel('job')->info("CANCEL Job for artist " . $this->artist->id);
            }
        }
        Log::channel('job')->info("END Job Queue for artist " . $this->artist->id);
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
//    public function middleware()
//    {
//
//        return [new RateLimited];
//    }
}
