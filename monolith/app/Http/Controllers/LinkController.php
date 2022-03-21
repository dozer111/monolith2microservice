<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Jobs\LinkCreated;
use App\Models\Link;
use App\Models\LinkProduct;
use dozer111\UsersMicroservice\UsersApi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    private UsersApi $service;

    public function __construct(UsersApi $service)
    {
        $this->service = $service;
    }

    public function index($id)
    {
        $links = Link::with('orders')->where('user_id', $id)->get();

        return LinkResource::collection($links);
    }

    public function store(Request $request)
    {
        $link = Link::create([
            'user_id' => $this->service->get('user')['id'],
            'code' => Str::random(6)
        ]);

        $items = [];
        foreach ($request->input('products') as $product_id) {
            $item = LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => $product_id
            ]);
            $items[] = $item->toArray();
        }

        $data = $link->toArray();
        $data['link_products'] = $items;
        LinkCreated::dispatch($data)->onQueue('checkout_topic');

        return $link;
    }
}
