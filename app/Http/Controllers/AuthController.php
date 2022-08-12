<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(UserRequest $request, User $user)
    {
        $newUser = $user->create($request->validated());
        return response()->json([
            'token' => $newUser->createToken("API TOKEN")->plainTextToken,
            'type' => 'Bearer',
            'user' => $newUser
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->noContent();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Send forgot password email.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        Password::broker()->sendResetLink(
            $request->only('email')
        );

        return response()->json(['message' => 'Reset password email sent']);
    }

    /**
     * Reset password.
     *
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function resetPassword(ResetPasswordRequest $request)
    // {
    //     $response = Password::broker()->reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
    //         $user->password = $password;
    //         $user->save();

    //        // event(new PasswordReset($user));
    //     });

    //     if ($response == Password::PASSWORD_RESET) {
    //         $token = auth()->fromUser(User::where('email', $request->email)->first());
    //         return $this->respondWithToken($token);
    //     }

    //     return  response()->json(['error' => trans($response)], 401);
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'data' => auth()->check() ? auth()->user()->only(['id', 'name', 'email']) : null
        ]);
    }
}
