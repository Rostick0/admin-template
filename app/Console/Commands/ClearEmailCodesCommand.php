<?php

namespace App\Console\Commands;

use App\Models\EmailCode;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearEmailCodesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-email-codes-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        EmailCode::where('created_at', '<=', Carbon::now()->subMinutes(15))->delete();
    }
}
