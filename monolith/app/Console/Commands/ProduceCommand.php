<?php

namespace App\Console\Commands;

use App\Jobs\OrderCompleted;
use App\Models\Order;
use Illuminate\Console\Command;
use App\Jobs\ProduceJob;

class ProduceCommand extends Command
{
    protected $signature = 'produce';

    public function handle()
    {
        $order = Order::find(1);
        $data = $order->toArray();
        $data['ambassador_revenue'] = $order->ambassador_revenue;
        $data['admin_revenue'] = $order->admin_revenue;

        OrderCompleted::dispatch($data)->onQueue('email_topic');
    }
}
