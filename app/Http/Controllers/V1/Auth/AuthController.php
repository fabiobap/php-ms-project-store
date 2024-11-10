<?php

namespace App\Http\Controllers\V1\Auth;

use App\Actions\Auth\CreateNewAccessToken;
use App\Actions\Auth\CreateNewRefreshToken;
use App\Actions\Auth\RegisterNewCustomer;
use App\DTO\NewUserCustomerDTO;
use App\Enums\APITokenTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserMeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request, CreateNewAccessToken $newAccessTokenAction, CreateNewRefreshToken $refreshTokenAction): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = Auth::user();

        $aToken = $newAccessTokenAction->handle($user);

        $rToken = $refreshTokenAction->handle($user);

        return $this->respondWithToken($aToken, $rToken);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(): UserMeResource
    {
        return new UserMeResource(auth()->user());
    }

    public function refresh(Request $request, CreateNewAccessToken $action): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $request->user()->tokens()->where('name', APITokenTypes::ACCESS_TOKEN->value)->delete();

        $aToken = $action->handle($user);

        return $this->respondWithToken($aToken);
    }

    public function register(
        RegisterRequest       $request,
        RegisterNewCustomer   $action,
        CreateNewAccessToken  $newAccessToken,
        CreateNewRefreshToken $newRefreshToken
    ): JsonResponse
    {
        $user = $action->handle(new NewUserCustomerDTO(...$request->validated()));

        $aToken = $newAccessToken->handle($user);
        $rToken = $newRefreshToken->handle($user);

        return $this->respondWithToken($aToken, $rToken);
    }

    private function respondWithToken(string $access_token, ?string $refresh_token = null): JsonResponse
    {
        $data = [
            'access_token' => $access_token,
            'token_type' => 'bearer',
            'expires_in' => config('sanctum.at_expiration')
        ];

        if ($refresh_token) {
            $data['refresh_token'] = $refresh_token;
        }
        return response()->json($data);
    }
}
