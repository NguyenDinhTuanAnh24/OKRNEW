<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // dd(Auth::check(), Auth::user(), Auth::guard());
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cập nhật thông tin cơ bản
        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'job_title' => $request->job_title,
        ];

        // Xử lý upload avatar
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($user->avatar_url && Storage::disk('public')->exists(str_replace('/storage/', '', $user->avatar_url))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar_url));
            }

            // Lưu avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_url'] = '/storage/' . $path;
        }

        // Cập nhật thông tin người dùng
        DB::table('users')->where('user_id', $user->user_id)->update($data);

        return redirect()->route('profile.show')->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
