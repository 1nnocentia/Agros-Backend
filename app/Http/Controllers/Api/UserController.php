<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'kelompok_tani_id' => 'sometimes|exists:kelompok_tani,id',
        ]);


        $user->fill($request->only(['name', 'phone', 'kelompok_tani_id']));
        $user->save();


        $user->load(['kelompokTani', 'lahan']);
        
        return new UserResource($user);
    }

    /**
     * Update FCM Token (Untuk Notifikasi)
     * Method: POST /api/fcm-token
     */
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $request->user()->update([
            'fcm_token' => $request->fcm_token
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Token notifikasi berhasil disimpan'
        ]);
    }
}
