<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = $request->user();

        if (!$user->isCustomer()) {
            return response()->json([
                'message' => 'You are not authorized to access this resource.'
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
