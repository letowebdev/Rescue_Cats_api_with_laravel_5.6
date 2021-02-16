<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostResource;
use App\Http\Resources\Users\PrivateUserResource;
use App\Models\User;
use App\Repositories\Contracts\PostInterface;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Eloquent\Criteria\forUser;
use App\Repositories\Eloquent\Criteria\isLive;

class UserController extends Controller
{
    protected $users;

    protected $posts;

    public function __construct(UserInterface $users, PostInterface $posts)
    {
        $this->middleware('auth:api');

        $this->users = $users;

        $this->posts = $posts;
    }

    public function index()
    {
        $users = $this->users->paginate(5);

        return PrivateUserResource::collection($users);
    }

    public function show($userId) {
        $posts = $this->posts->findWhere('user_id', $userId);

        return PostResource::collection($posts);
    
    }

    public function findByUsername($username)
    {
        $user = $this->users->findWhereFirst('username', $username);

        return new PrivateUserResource($user);
    }

    public function userOwnsPost($id)
    {
        $post = $this->posts->withCriteria([new forUser(auth()->user()->id)])
                            ->findWhereFirst('id', $id);

        return new PostResource($post);
    }
}
