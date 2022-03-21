<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Models\LinkProduct;
use App\Services\UsersService;
use dozer111\UsersMicroservice\UsersApi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public UsersApi $userService;

    public function __construct(UsersApi $userService)
    {
        $this->userService = $userService;
    }

    public function show($code)
    {
        $link = Link::with('products')->where('code', $code)->first();
        $user = $this->userService->get("users/{$link->user_id}");
        $link['user'] = $user;

        return $link;
    }
}
