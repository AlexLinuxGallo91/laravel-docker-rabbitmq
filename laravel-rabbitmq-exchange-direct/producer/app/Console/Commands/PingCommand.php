<?php

namespace App\Console\Commands;

use App\Jobs\PingJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping to a consumer with rabbitmq';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        PingJob::dispatch(['fecha'=>$date->toDateString()]);
    }
}
