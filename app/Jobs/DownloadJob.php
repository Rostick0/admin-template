<?php

namespace App\Jobs;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        // protected $data,
        // protected $format
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $extension = 'json';

        $date = Carbon::now();

        $dir = 'download/file/';
        $random_name = $dir . $date->format('Y/m/d') . '/' . random_int(1000, 9999) . time() . '.' . $extension;
        $random_name_with_extension = 'public/' . $random_name;

        Storage::makeDirectory('public/' . $dir . $date->format('Y'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m/d'));

        Storage::put($random_name_with_extension, json_encode(Product::all()));
    }
}
