<?php

namespace App\Jobs;

use App\Helper\InstagramHelper;
use App\Models\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Exception;

class CollectArtistInstagramData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static $releaseTimeShift = 10;
    public $tries = 25;
    /**
     * @var Artist
     */
    public $artist;
    /**
     * @var InstagramHelper
     */
    public $instgramHelper;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
        $this->instgramHelper = new InstagramHelper();
//        $this->releaseTimeShift = 10;
    }

    public function handle()
    {
        //                $this->release(10);
//            Log::channel('job')->info("TRY Job for artist " . $this->artist->id);

        try {
            Log::channel('job')->info("TRY Job for artist " . $this->artist->id);
            $this->artist->instagram_data = $this->instgramHelper->getInstagramInfoOrFail($this->artist->instagram_url);
            $this->artist->save();
            $this->releaseTimeShift = 10;
        } catch (Exception $e) {
            if ($this->releaseTimeShift < 604800) {
                Log::channel('job')->info("RESCHEDULE Job for artist " . $this->artist->id);
                $this->releaseTimeShift *= 2;
                $this->release($this->releaseTimeShift);
            }
            Log::channel('job')->info("FAILED Job for artist " . $this->artist->id);
        }
        Log::channel('job')->info("ENDED Job for artist " . $this->artist->id);
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
