<?php

namespace App\Actions\Admin\User;

use App\Http\Requests\Admin\BasicIndexRequest;
use App\Models\User;

class RetrieveAllAdmins
{
    public function handle(BasicIndexRequest $request)
    {
        $per_page = $request->input('per_page', 15);
        $orderBy = $request->input('order_by', 'created_at');
        $orderDir = $request->input('order_dir', 'desc');

        return User::admin()
            ->orderBy($orderBy, $orderDir)
            ->paginate($per_page);
    }
}
