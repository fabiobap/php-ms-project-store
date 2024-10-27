<?php

namespace App\Http\Controllers\V1\Admin\Users;

use App\Actions\Admin\User\RetrieveAllAdmins;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Http\Resources\Admin\Users\UserResourceCollection;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(BasicIndexRequest $request, RetrieveAllAdmins $action): UserResourceCollection
    {
        return new UserResourceCollection($action->handle($request));
    }
}
