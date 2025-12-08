<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Role;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Register user baru dari Flutter (auto-assign sebagai Petani)
     */
    public function loginWithPhone(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => ['required', 'string', 'max:20'],
            // 'firebase_token' => ['required', 'string'],
        ]);

        $user = User::firstOrCreate(
            ['phone_number' => $validated['phone_number']],
            [
                'name' => 'Petani',
                'role_id' => Role::PETANI,
                'wa_verified' => false,
            ]
        );

        if ($user->Role::PETANI) {
            return response()->json([
                'message' => 'Akses ditolak. Akun ini bukan akun Petani.',
            ], 403);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login Berhasil',
            'token' => $token,
            'data' => new UserResource($user),
        ]);
    }

    /**
     * Current User
     */
    public function me(Request $request)
    {
        $user = $request->user();
        
        $user->load(['kelompokTani', 'lahan']); 

        return new UserResource($user);
    }

    /**
     * Logout - revoke token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout Berhasil',
        ]);
    }

}
