<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinksSeeder extends Seeder
{
    public function run()
    {
        $items = \DB::connection('mysql_old')->table('links')->get();

        foreach ($items as $item){
            Link::create([
                'id' => $item->id,
                'code' => $item->code,
                'user_id' => $item->user_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }
}
