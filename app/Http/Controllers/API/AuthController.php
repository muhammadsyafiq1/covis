<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            // dd($request->input());
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])) {
                throw new Exception('Invalid Credentials');
            }
            if(!$user->hasRole('Surveyor')) {
                throw new Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('auth_token')->plainTextToken;

            $update_user = User::where('email', $request->email)->first();
            $update_user->update([
                'is_logged_in' => 1
            ]);
            $res = User::with('JobPosition')->where('email', $request->email)->first();

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $res
            ], 'Authenticated');

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function checkLoggedIn(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return [
                'is_logged_in' => 'User not found!'
            ];
        } else {
            return [
                'is_logged_in' => $user->is_logged_in
            ];
        }

    }

    public function logout()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'is_logged_in' => 0
        ]);
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out'
        ];
    }

    public function detail()
    {
        $user = User::with('jobPosition', 'userImage', 'userDetail')->findOrFail(Auth::user()->id);
        return ResponseFormatter::success($user, 'Detail successfully generated');
    }
}
