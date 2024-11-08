<?php

namespace App\Http\Controllers\V1\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        $user->load('role');
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
