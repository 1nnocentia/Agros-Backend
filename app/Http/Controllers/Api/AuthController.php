<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Role;

class AuthController extends Controller
{
    /**
     * Register user baru dari Flutter (auto-assign sebagai Petani)
     */
    public function loginWithPhone(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'] ?? null,
            'role_id' => Role::PETANI,
            'wa_verified' => false,
        ]);

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone_number' => $user->phone_number,
                'role' => $user->role->role_name ?? 'Petani',
            ],
            'token' => $token,
        ], 201);
    }

    /**
     * Login untuk user Flutter
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Cek apakah user adalah Petani (hanya Petani yang boleh login di mobile)
        if ($user->role_id !== 2) {
            return response()->json([
                'message' => 'Access denied. Only Petani can access mobile app.',
            ], 403);
        }

        // Generate token baru
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'role' => $user->role->role_name ?? 'Petani',
            ],
            'token' => $token,
        ], 200);
    }

    /**
     * Logout - revoke token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }

    /**
     * Get authenticated user info
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'wa_verified' => $user->wa_verified,
                'role' => $user->role->role_name ?? 'Petani',
                'kelompok_tani' => $user->kelompokTani ? [
                    'id' => $user->kelompokTani->id,
                    'name' => $user->kelompokTani->kelompok_tani,
                ] : null,
            ],
        ], 200);
    }
}
