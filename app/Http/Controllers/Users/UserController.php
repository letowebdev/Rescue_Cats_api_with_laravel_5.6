<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\PrivateUserResource;
use App\Models\User;
use App\Repositories\Contracts\UserInterface;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserInterface $users)
    {
        $this->middleware('auth:api');

        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->paginate(5);

        return PrivateUserResource::collection($users);
    }
}
