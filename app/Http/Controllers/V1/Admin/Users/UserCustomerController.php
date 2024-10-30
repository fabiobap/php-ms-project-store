<?php

namespace App\Http\Controllers\V1\Admin\Users;

use App\Actions\Admin\User\RetrieveAllCustomers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Http\Resources\Admin\Users\UserResourceCollection;

class UserCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(BasicIndexRequest $request, RetrieveAllCustomers $action): UserResourceCollection
    {
        return new UserResourceCollection($action->handle($request));
    }
}
