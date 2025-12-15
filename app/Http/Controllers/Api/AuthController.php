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
            'phone_number' => [
                'required', 
                'string', 
                'regex:/^(\+62|62|0)8[0-9]{7,12}$/'],
            // 'firebase_token' => ['required', 'string'],
        ],
        [
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.regex' => 'Format nomor telepon tidak valid. Gunakan format 08xxxxxxxxx.',
        ]
    );

    $phoneNumber = $validated['phone_number'];
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } elseif (substr($phoneNumber, 0, 2) === '62') {
            $phoneNumber = $phoneNumber;
        }

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
