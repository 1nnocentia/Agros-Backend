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
        ]);


        $user->fill($request->only(['name', 'phone']));
        $user->save();


        $user->load(['kelompokTani', 'lahan']);
        
        return response()->json([
            'status'  => 'success',
            'message' => 'Profil berhasil diperbarui',
            'data'    => new UserResource($user),
        ]);
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
