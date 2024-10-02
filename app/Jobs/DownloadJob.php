<?php

namespace App\Jobs;

use App\Models\Product;
use App\Utils\Uploader\AbstractUploader;
// use App\Utils\Uploader\Json;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Output\ConsoleOutput;
use Laravel\SerializableClosure\SerializableClosure;
use Rostislav\LaravelFilters\Filter;

class DownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $model,
        protected AbstractUploader $uploader,
        protected $request,
        protected $fillable_block = [],
        protected $where = [],
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $date = Carbon::now();
        $extension = $this->uploader::$extension;

        $dir = 'download/file/';
        $random_name = $dir . $date->format(format: 'Y/m/d') . '/' . random_int(1000, 9999) . time() . '.' . $extension;
        $random_name_with_extension = 'public/' . $random_name;

        Storage::makeDirectory('public/' . $dir . $date->format('Y'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m/d'));

        $data = Filter::query($this->request, new $this->model, $this->fillable_block, $this->where)->cursor();

        $this->uploader::download(
            $data,
            $random_name_with_extension
        );
    }
}
