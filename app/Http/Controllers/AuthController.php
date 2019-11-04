<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="My First Lumen API", version="0.1")
 */

/**
 * @OA\Server(url=API_HOST)
 */

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    /**
    * @OA\Post(
    *     path="/api/login",
    *     tags={"Login"},
    *     summary="Login in aplication",
    *     @OA\Parameter(
    *         name="email",
    *         in="query",
    *         description="The user email for login",
    *         required=true,
    *         @OA\Schema(
    *             type="string"
    *         )
    *     ),
    *     @OA\Parameter(
    *         name="password",
    *         in="query",
    *         required=true,
    *         @OA\Schema(
    *             type="string",
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User Logged In + bearer token"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Invalid username/password supplied"
    *     ),
    * )
    */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

}