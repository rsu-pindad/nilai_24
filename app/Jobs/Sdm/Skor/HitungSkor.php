<?php

namespace App\Jobs\Sdm\Skor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class HitungSkor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Bus::chain([
        //     new SyncSelf(),
        //     new SyncAtasan(),
        //     new SyncRekanan(),
        //     new SyncStaff()
        // ])->dispatch();
        Bus::batch([
            [
                new SyncSelf,
            ],
            [
                new SyncAtasan,
            ],
            [
                new SyncRekanan,
            ],
            [
                new SyncStaff,
            ],
        ])->onConnection('redis')->onQueue('hitung-skor')->dispatch();
    }
}
