<?php

namespace Database\Seeders;

use App\Models\LinkProduct;
use Illuminate\Database\Seeder;

class LinkProductsSeeder extends Seeder
{
    public function run()
    {
        $items = \DB::connection('mysql_old')->table('link_products')->get();

        foreach ($items as $item) {
            LinkProduct::create([
                'id' => $item->id,
                'link_id' => $item->link_id,
                'product_id' => $item->product_id,
            ]);
        }
    }
}
