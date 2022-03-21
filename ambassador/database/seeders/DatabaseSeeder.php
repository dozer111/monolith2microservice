<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            LinksSeeder::class,
            LinkProductsSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
