<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        Order::create([
            'id' => $data['id'],
            'code' => $data['code'],
            'transaction_id' => $data['transaction_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'user_id' => $data['user_id'],
            'ambassador_email' => $data['ambassador_email'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'zip' => $data['zip'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);

        OrderItem::insert($data['order_items']);
    }
}
