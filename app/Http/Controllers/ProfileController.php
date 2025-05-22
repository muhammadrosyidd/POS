<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = UserModel::with('level')->find(Auth::id());

        $breadcrumb = (object) [
            'title' => 'Profile Setting',
            'list' => ['Home', 'User', 'Profile Setting'],
        ];

        $page = (object) [
            'title' => 'Profile Setting',
        ];

        $activeMenu = 'profile'; // Perbaikan di sini

        return view('profile.index', compact('user', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = UserModel::find(Auth::id());

        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $filename = time() . '.' . $request->avatar->extension();
            $path = 'avatars/' . $filename;
            $request->avatar->move(public_path('avatars'), $filename);

            $user->update(['avatar' => $path]);

            return response()->json([
                'status' => true,
                'message' => 'Avatar berhasil diperbarui!',
                'new_avatar_url' => asset($path),
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Gagal memperbarui avatar.']);
    }
}