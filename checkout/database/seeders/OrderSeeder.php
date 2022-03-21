<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $items = \DB::connection('mysql_old')->table('orders')->get();

        foreach ($items as $item){
            Order::create([
                'id' => $item->id,
                'transaction_id' => $item->transaction_id,
                'user_id' => $item->user_id,
                'code' => $item->code,
                'ambassador_email' => $item->ambassador_email,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'address' => $item->address,
                'city' => $item->city,
                'country' => $item->country,
                'zip' => $item->zip,
                'complete' => $item->complete,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }

        $items = \DB::connection('mysql_old')->table('order_items')->get();
        foreach ($items as $item){
            OrderItem::create([
                'id' => $item->id,
                'order_id' => $item->order_id,
                'product_title' => $item->product_title,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'admin_revenue' => $item->admin_revenue,
                'ambassador_revenue' => $item->ambassador_revenue,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }

    }
}
