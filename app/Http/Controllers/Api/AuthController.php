<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['required'],
            'photo' => ['nullable', 'image'],
        ]);

        $user = User::create([
            'account_id' => 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()
            ->json([
                'token_type'=>'Bearer',
                'token' => $token,
            ], 200);
    }

    public function login(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($data))
            return response()->json(['error' => 'Unauthorised'], 401);

        $token = auth()->user()->createToken('PersonalAccessToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(){
        return response()->json(Auth::user());
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
