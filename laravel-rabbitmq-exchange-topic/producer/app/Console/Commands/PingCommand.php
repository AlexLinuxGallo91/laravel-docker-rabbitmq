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

        $keyQueues = ['zick', 'zack'];
        $randomQueue = $keyQueues[array_rand($keyQueues)];
        $date = Carbon::now();

        // establece parametros dinamicos en la conexion del queue de rabbitmq
        config([
            'queue.connections.rabbitmq.queue' => $randomQueue,
            'queue.connections.rabbitmq.options.queue.exchange_routing_key' => $randomQueue
        ]);

        print("Queue y routing key establecido: " . $randomQueue . "\n");

        PingJob::dispatch([
            'fecha' => $date->toDateString(),
            'queue' => $randomQueue,
        ]);
    }
}
