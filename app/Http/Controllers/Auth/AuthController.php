<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends AccessTokenController
{
    /**
     * @param ServerRequestInterface $request
     * @return \Illuminate\Support\Collection|mixed
     */
    public function auth(ServerRequestInterface $request)
    {
        $tokenResponse = parent::issueToken($request);
        $token = $tokenResponse->getContent();

        $tokenInfo = json_decode($token, true);

        return $tokenInfo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('web')->user();
            $user->roles;

            $token = $user->createToken($user->email . '-' . now());

            return response()->json([
                'user' => $user,
                'token' => $token->accessToken
            ]);
        }
    }
}
