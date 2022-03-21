<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Order;
use dozer111\UsersMicroservice\UsersApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StatsController extends Controller
{
    private UsersApi $service;

    public function __construct(UsersApi $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $user = $this->service->get('user');

        $links = Link::where('user_id', $user['id'])->get();

        return $links->map(function (Link $link) {
            $orders = Order::where('code', $link->code)->where('complete', 1)->get();

            return [
                'code' => $link->code,
                'count' => $orders->count(),
                'revenue' => $orders->sum(fn(Order $order) => $order->ambassador_revenue)
            ];
        });
    }

    public function rankings()
    {
        return Redis::zrevrange('rankings', 0, -1, 'WITHSCORES');
    }
}
