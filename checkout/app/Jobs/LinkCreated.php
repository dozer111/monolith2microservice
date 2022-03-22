<?php

namespace App\Jobs;

use App\Models\Link;
use App\Models\LinkProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LinkCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        var_dump($this->data);
        $data = $this->data;

        Link::create([
            'id' => $data['id'],
            'code' => $data['code'],
            'user_id' => $data['user_id'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);

        LinkProduct::insert($data['link_products']);
    }
}
