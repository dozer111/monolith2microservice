<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = \DB::connection('mysql_old')->table('orders')->get();

        foreach ($orders as $order){

            $orderItems = \DB::connection('mysql_old')
                ->table('order_items')
                ->where('order_id',$order->id)
                ->get();

            Order::create([
                'id' => $order->id,
                'user_id' => $order->user_id,
                'code' => $order->code,
                'total' => $orderItems->sum(fn($item) => $item->ambassador_revenue),
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ]);
        }
    }
}
