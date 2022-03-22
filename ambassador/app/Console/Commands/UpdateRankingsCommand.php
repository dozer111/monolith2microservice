<?php

namespace App\Console\Commands;

use App\Models\Order;
use dozer111\UsersMicroservice\UsersApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class UpdateRankingsCommand extends Command
{
    protected $signature = 'update:rankings';

    private UsersApi $userService;

    public function __construct(UsersApi $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function handle()
    {
        $users = collect($this->userService->get('users'));
        $ambassadors = $users->filter(fn($user) => $user['is_admin'] === 0)->values();

        $bar = $this->output->createProgressBar($ambassadors->count());

        $bar->start();

        $ambassadors->each(function ($user) use ($bar) {
            $orders = Order::where('user_id',$user['id'])->get();
            $revenue = $orders->sum(fn(Order $order) => $order->total);

            Redis::zadd('rankings', (int)$revenue, $user['first_name'].' '.$user['last_name']);

            $bar->advance();
        });

        $bar->finish();
    }
}
