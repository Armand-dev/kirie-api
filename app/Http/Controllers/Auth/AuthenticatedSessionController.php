<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Resources\Landlord\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors' => [
                    'Credentials do not match our records!'
                ]
            ], 403));
        }

        return response()->json([
            'success' => true,
            'data' => [
                'user' => new UserResource(\auth()->user()),
                'access_token' => \auth()->user()->createToken('access-token'),
                'billing_portal_url' => $request->user()->billingPortalUrl(route('test'))
            ]
        ]);
    }

    /**
     * Handle an incoming token verification request.
     */
    public function verifyToken(Request $request): JsonResponse
    {
        $request->validate([
            'api_token' => ['required']
        ]);

        $accessToken = PersonalAccessToken::findToken($request->get('api_token'));
        $user = $accessToken->tokenable;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => new UserResource($user),
                'access_token' => [
                    'accessToken' => $accessToken->toArray(),
                    'plainTextToken' => $request->get('api_token')
                ]
            ]
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(LogoutRequest $request): JsonResponse
    {
//        \auth()->user()->currentAccessToken()->delete();
        \auth()->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}
