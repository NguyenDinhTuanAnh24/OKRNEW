<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if ($user) {
            // Tải lại bản ghi mới nhất từ DB để đảm bảo avatar_url mới được hiển thị
            $user->refresh();
        }
        if (!$user) {
            return redirect()->route('login')->withErrors('Bạn cần đăng nhập để xem hồ sơ.');
        }
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cập nhật thông tin cơ bản
        $user->full_name = $request->full_name;

        // Xử lý upload avatar
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            // Xóa avatar cũ nếu có
            if ($user->avatar_url) {
                $oldPath = str_starts_with($user->avatar_url, '/storage/')
                    ? str_replace('/storage/', '', $user->avatar_url)
                    : $user->avatar_url;
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Lưu avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');
            // Lưu đường dẫn tương đối (ví dụ: avatars/abc.png). Khi hiển thị sẽ dùng Storage::url()
            $user->avatar_url = $path;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
