<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \App\Http\Resources\UserResource
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        event(new UserCreated($user));

        return new UserResource($user);
    }
}
