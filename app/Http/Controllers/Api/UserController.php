<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());
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
