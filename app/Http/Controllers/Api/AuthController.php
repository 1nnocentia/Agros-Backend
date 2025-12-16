<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\MobileLoginRequest;

class AuthController extends Controller
{
    /**
     * Register user baru dari Flutter (auto-assign sebagai Petani)
     */
    public function loginWithPhone(MobileLoginRequest $request)
    {
        $phoneNumber = $request->getFormattedPhoneNumber();

        $user = User::firstOrCreate(
            ['phone_number' => $phoneNumber],
            [
                'name' => 'Petani',
                'role_id' => Role::PETANI,
                'wa_verified' => false,
            ]
        );

        if ($user->role_id !== Role::PETANI) {
            return response()->json([
                'message' => 'Akses ditolak. Akun ini bukan akun Petani.',
            ], 403);
        }

        $user->load(['kelompokTani', 'role']);

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login Berhasil',
            'token' => $token,
            'data' => new UserResource($user),
        ]);
    }

    public function checkPhoneAvailability(MobileLoginRequest $request) 
    {
        $phoneNumber = $request->getFormattedPhoneNumber();

        $exists = User::where('phone_number', $phoneNumber)->exists();

        return response()->json([
            'status' => 'success',
            'exists' => $exists,
        ]);
    }

    /**
     * Get Current User Profile
     */
    public function profile(Request $request)
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
